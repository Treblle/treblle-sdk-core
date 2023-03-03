<?php

declare(strict_types=1);

namespace Treblle\Core\DataObjects;

use Treblle\Core\Concerns\CanBeSerialized;
use Treblle\Core\Contracts\DataObjects\TreblleObject;

final class OS implements TreblleObject
{
    use CanBeSerialized;

    /**
     * @param string|null $name The name of the server OS: Linux, Windows, etc.
     * @param string|null $release The version of the server OS.
     * @param string|null $architecture The server architecture.
     */
    public function __construct(
        public readonly null|string $name,
        public readonly null|string $release,
        public readonly null|string $architecture,
    ) {
    }

    /**
     * @return array{
     *     name: null|string,
     *     release: null|string,
     *     architecture: null|string,
     * }
     */
    public function __toArray(): array
    {
        return [
            'name' => $this->name,
            'release' => $this->release,
            'architecture' => $this->architecture,
        ];
    }
}
