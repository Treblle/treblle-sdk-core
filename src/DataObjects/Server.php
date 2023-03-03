<?php

declare(strict_types=1);

namespace Treblle\Core\DataObjects;

use Treblle\Core\Concerns\CanBeSerialized;
use Treblle\Core\Contracts\DataObjects\TreblleObject;

final class Server implements TreblleObject
{
    use CanBeSerialized;

    /**
     * @param string|null $ip The IP address of the server.
     * @param string|null $timezone The timezone of the server: UTC, America/New_York, Europe/Lisbon,
     * @param string|null $software THe software used on the server.
     * @param string|null $signature The signature of the server software, if there is one.
     * @param string|null $protocol The HTTP protocol used
     * @param OS|null $os The OS object
     * @param string|null $encoding
     */
    public function __construct(
        public readonly null|string $ip,
        public readonly null|string $timezone,
        public readonly null|string $software,
        public readonly null|string $signature,
        public readonly null|string $protocol,
        public readonly null|OS $os,
        public readonly null|string $encoding,
    ) {
    }

    /**
     * @return array{
     *     ip: null|string,
     *     timezone: null|string,
     *     software: null|string,
     *     signature: null|string,
     *     protocol: null|string,
     *     os: array{
     *         name: null|string,
     *         release: null|string,
     *         architecture: null|string
     *     }|null,
     *     encoding: null|string
     * }
     */
    public function __toArray(): array
    {
        return [
            'ip' => $this->ip,
            'timezone' => $this->timezone,
            'software' => $this->software,
            'signature' => $this->signature,
            'protocol' => $this->protocol,
            'os' => $this->os?->__toArray(),
            'encoding' => $this->encoding,
        ];
    }
}
