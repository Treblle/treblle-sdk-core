<?php

declare(strict_types=1);

namespace Treblle\Core\Contracts\DataObjects;

use JsonSerializable;

interface TreblleObject extends JsonSerializable
{
    /**
     * @return array
     */
    public function jsonSerialize(): array;

    /**
     * @return array
     */
    public function __toArray(): array;
}
