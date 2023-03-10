<?php

declare(strict_types=1);

namespace Treblle\Core\DataProviders;

use Treblle\Core\Contracts\DataProviders\ServerContract;
use Treblle\Core\DataObjects\OS;
use Treblle\Core\DataObjects\Server;

final class GlobalServerProvider implements ServerContract
{
    public function get(): Server
    {
        return new Server(
            ip: $this->variable('SERVER_ADDR'),
            timezone: date_default_timezone_get(),
            software: $this->variable('SERVER_SOFTWARE'),
            signature: $this->variable('SERVER_SIGNATURE'),
            protocol: $this->variable('SERVER_PROTOCOL'),
            os: new OS(
                name: PHP_OS,
                release: php_uname('r'),
                architecture: php_uname('m'),
            ),
            encoding: $this->variable('HTTP_ACCEPT_ENCODING')
        );
    }

    private function variable(string $variable): ?string
    {
        return $_SERVER[$variable] ?? null;
    }
}
