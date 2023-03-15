<?php

declare(strict_types=1);

namespace Treblle\Core\DataProviders;

use RuntimeException;
use Throwable;
use Treblle\Core\Contracts\DataProviders\ErrorContract;
use Treblle\Core\Contracts\DataProviders\ResponseContract;
use Treblle\Core\Contracts\Masking\MaskingContract;
use Treblle\Core\DataObjects\Error;
use Treblle\Core\DataObjects\Response;

final class OutputBufferResponseProvider implements ResponseContract
{
    public function __construct(
        private ErrorContract $error,
        private MaskingContract $masker,
    ) {
        if (ob_get_level() < 1) {
            throw new RuntimeException(
                message: 'Output buffering must be enabled to collect responses. Have you called `ob_start()`?',
            );
        }
    }

    public function get(): Response
    {
        $responseSize = ob_get_length() ?: 0;
        $body = $this->masker->mask(
            data: $this->getResponseBody($responseSize),
        );

        $responseCode = http_response_code() ?: null;

        return new Response(
            headers: $this->getResponseHeaders(),
            code: is_int($responseCode) ? $responseCode : null,
            size: $responseSize,
            load_time: $this->getLoadTime(),
            body: $body,
        );
    }

    private function getResponseHeaders(): array
    {
        $data = [];
        $headers = headers_list();

        if (! empty($headers)) {
            foreach ($headers as $header) {
                $header = explode(':', $header);
                $data[array_shift($header)] = trim(implode(':', $header));
            }
        }

        return $data;
    }

    private function getResponseBody(int $responseSize): array
    {
        if ($responseSize >= 2_000_000) {
            $this->error->add(
                error: new Error(
                    source: 'onShutdown',
                    type: 'E_USER_ERROR',
                    message: 'JSON response size is over 2MB',
                    file: null,
                    line: null,
                )
            );

            return [];
        }

        try {
            $output = ob_get_flush();
            if (! is_string($output)) {
                return [];
            }

            return (array) json_decode(
                json: $output,
                associative: true,
                depth: 512,
                flags: JSON_THROW_ON_ERROR,
            );
        } catch (Throwable $exception) {
            $this->error->add(
                error: new Error(
                    source: 'onShutdown',
                    type: 'INVALID_JSON',
                    message: 'Invalid JSON format: ' . $exception->getMessage(),
                    file: null,
                    line: null,
                )
            );
        }

        return [];
    }

    private function getLoadTime(): float
    {
        if (isset($_SERVER['REQUEST_TIME_FLOAT'])) {
            return (float) microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
        }

        return 0.0000;
    }
}
