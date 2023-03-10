<?php

declare(strict_types=1);

namespace Treblle\Core;

use JsonException;
use Throwable;
use Treblle\Core\Contracts\DataProviders\ErrorContract;
use Treblle\Core\Contracts\DataProviders\LanguageContract;
use Treblle\Core\Contracts\DataProviders\RequestContract;
use Treblle\Core\Contracts\DataProviders\ResponseContract;
use Treblle\Core\Contracts\DataProviders\ServerContract;
use Treblle\Core\Contracts\Http\ShutdownHandlerContract;
use Treblle\Core\DataObjects\Data;
use Treblle\Core\DataObjects\Error;
use Treblle\Core\Support\ErrorType;

final class Treblle
{
    public function __construct(
        private readonly Configuration $configuration,
        private readonly ServerContract $server,
        private readonly LanguageContract $language,
        private readonly RequestContract $request,
        private readonly ResponseContract $response,
        public readonly ErrorContract $error,
        public ShutdownHandlerContract $handler,
        private readonly bool $debug = false,
    ) {
    }

    public function name(): string
    {
        return 'php';
    }

    public function version(): float
    {
        return 0.8;
    }

    /**
     * @return array
     * @throws Throwable
     */
    public function buildPayload(): array
    {
        return [
            'api_key' => $this->configuration->apiKey,
            'project_id' => $this->configuration->projectId,
            'version' => $this->version(),
            'sdk' => $this->name(),
            'data' => new Data(
                server: $this->server->get(),
                language: $this->language->get(),
                request: $this->request->get(),
                response: $this->response->get(),
                errors: $this->error->get()
            ),
        ];
    }

    /**
     * @return mixed
     * @throws Throwable
     * @throws JsonException
     */
    public function onShutdown(): mixed
    {
        try {
            return  $this->handler->handle(
                payload: $this->buildPayload(),
                configuration: $this->configuration,
            );
        } catch (Throwable $exception) {
            if ($this->debug) {
                throw $exception;
            }

            return null;
        }
    }

    /**
     * @param int $type
     * @param string $message
     * @param string $file
     * @param int $line
     * @return bool
     * @throws Throwable
     */
    public function onError(int $type, string $message, string $file, int $line): bool
    {
        try {
            $this->error->add(
                error: new Error(
                    source: 'onError',
                    type: ErrorType::get(
                        type: $type,
                    ),
                    message: $message,
                    file: $file,
                    line: $line,
                ),
            );
        } catch (Throwable $throwable) {
            if ($this->debug) {
                throw $throwable;
            }
        }

        return false;
    }

    /**
     * @param Throwable $exception
     * @return void
     * @throws Throwable
     */
    public function onException(Throwable $exception): void
    {
        try {
            $this->error->add(
                error: new Error(
                    source: 'onException',
                    type: 'UNHANDLED_EXCEPTION',
                    message: $exception->getMessage(),
                    file: $exception->getFile(),
                    line: $exception->getLine(),
                ),
            );
        } catch (Throwable $exception) {
            if ($this->debug) {
                throw $exception;
            }
        }
    }
}
