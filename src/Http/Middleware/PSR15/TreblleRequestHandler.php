<?php

declare(strict_types=1);

namespace Treblle\Core\Http\Middleware\PSR15;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;

final class TreblleRequestHandler implements RequestHandlerInterface
{
    public function __construct(
        private MiddlewareInterface $middleware,
        private RequestHandlerInterface $next,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->middleware->process(
            request: $request->withHeader(
                'X-TREBLLE-TRACE',
                Uuid::uuid4()->toString(),
            ),
            handler: $this->next,
        );
    }
}
