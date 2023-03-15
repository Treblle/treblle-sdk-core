<?php

declare(strict_types=1);

namespace Treblle\Core\Http\Middleware\Guzzle;

use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\Uuid;

final class TreblleTrace
{
    /**
     * Add the `X-TREBLLE-TRACE` header to the request, so that you can track external API calls.
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public function __invoke(RequestInterface $request, array $options = []): RequestInterface
    {
        return $request->withHeader(
            'X-TREBLLE-TRACE',
            Uuid::uuid4()->toString(),
        );
    }
}
