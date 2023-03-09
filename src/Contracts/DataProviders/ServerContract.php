<?php

declare(strict_types=1);

namespace Treblle\Core\Contracts\DataProviders;

use Treblle\Core\DataObjects\Server;

interface ServerContract
{
    public function get(): Server;
}
