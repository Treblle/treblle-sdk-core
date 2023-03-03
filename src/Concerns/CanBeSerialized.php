<?php

declare(strict_types=1);

namespace Treblle\Core\Concerns;

use Treblle\Core\Contracts\DataObjects\TreblleObject;

/**
 * @mixin TreblleObject
 */
trait CanBeSerialized
{
    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return get_object_vars(
            object: $this,
        );
    }
}
