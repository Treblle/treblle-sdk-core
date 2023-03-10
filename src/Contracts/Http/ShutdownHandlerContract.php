<?php

declare(strict_types=1);

namespace Treblle\Core\Contracts\Http;

use Treblle\Core\Configuration;

interface ShutdownHandlerContract
{
    public function handle(array $payload, Configuration $configuration): mixed;
}
