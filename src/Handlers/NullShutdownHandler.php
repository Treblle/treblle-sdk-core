<?php

declare(strict_types=1);

namespace Treblle\Core\Handlers;

use Treblle\Core\Configuration;
use Treblle\Core\Contracts\Http\ShutdownHandlerContract;

final class NullShutdownHandler implements ShutdownHandlerContract
{
    public function handle(array $payload, Configuration $configuration): mixed
    {
        return null;
    }
}
