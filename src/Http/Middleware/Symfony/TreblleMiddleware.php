<?php

declare(strict_types=1);

namespace Treblle\Core\Http\Middleware\Symfony;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpCache\StoreInterface;
use Symfony\Component\HttpKernel\HttpCache\SubRequestHandler;
use Symfony\Component\HttpKernel\HttpCache\SurrogateInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

final class TreblleMiddleware
{
    public function __construct(
        private HttpKernelInterface $kernel,
        private StoreInterface $store,
        private null|SurrogateInterface $surrogate = null,
        private array $options = [],
    ) {}

    public function handle(Request $request, int $type = HttpKernelInterface::MAIN_REQUEST, bool $catch = true): Response
    {
        $request->headers->set(
            key: 'X-TREBLLE_TRACE',
            values: Uuid::uuid4()->toString(),
        );

        return SubRequestHandler::handle(
            kernel: $this->kernel,
            request: $request,
            type: $type,catch: $catch,
        );
    }
}
