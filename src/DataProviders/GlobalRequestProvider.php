<?php

declare(strict_types=1);

namespace Treblle\Core\DataProviders;

use Safe\Exceptions\ApacheException;
use Throwable;
use Treblle\Core\Contracts\DataProviders\RequestContract;
use Treblle\Core\Contracts\Masking\MaskingContract;
use Treblle\Core\DataObjects\Request;
use Treblle\Core\Http\Method;

final class GlobalRequestProvider implements RequestContract
{
    public function __construct(
        private MaskingContract $masker,
    ) {
    }

    /**
     * @throws ApacheException
     */
    public function get(): Request
    {
        return new Request(
            timestamp: gmdate('Y-m-d H:i:s'),
            ip: $this->getClientIpAddress(),
            url: $this->getEndpointUrl(),
            user_agent: $this->getUserAgent(),
            method: isset($_SERVER['REQUEST_METHOD'])
                ? Method::tryFrom(
                    value: $_SERVER['REQUEST_METHOD'],
                ) : null,
            headers: headers_list(),
            body: $this->masker->mask(
                data: $_REQUEST,
            ),
            raw: $this->getRawPayload(),
        );
    }

    private function getClientIpAddress(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip_address = $_SERVER['REMOTE_ADDR'] ?? '<unknown>';
        }

        return $ip_address;
    }

    private function getEndpointUrl(): string
    {
        $protocol = $_SERVER['HTTPS'] ?? null !== 'off' ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'] ?? '<unknown>';
        $uri = $_SERVER['REQUEST_URI'] ?? '<unknown>';

        return $protocol.$host.$uri;
    }

    private function getUserAgent(): string
    {
        $user_agent = '';

        if (isset($_SERVER['HTTP_USER_AGENT']) && !empty($_SERVER['HTTP_USER_AGENT'])) {
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
        }

        return $user_agent;
    }

    private function getRawPayload(): array
    {
        try {
            $rawBody = json_decode(
                json: (string) file_get_contents('php://input'),
                associative: true,
                flags: JSON_THROW_ON_ERROR,
            );

            return $this->masker->mask(
                data: (array) $rawBody,
            );
        } catch (Throwable $exception) {
            return [];
        }
    }
}
