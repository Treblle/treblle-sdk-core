<?php

declare(strict_types=1);

namespace Treblle\Core\Http\Middleware\PSR15;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;

final class TreblleMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle(
            request: $request->withHeader(
                'X-TREBLLE-TRACE',
                Uuid::uuid4()->toString(),
            ),
        );
    }
}
