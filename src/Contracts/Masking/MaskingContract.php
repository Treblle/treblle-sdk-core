<?php

declare(strict_types=1);

namespace Treblle\Core\Contracts\Masking;

interface MaskingContract
{
    public function mask(array $data): array;
}
