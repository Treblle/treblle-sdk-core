<?php

declare(strict_types=1);

namespace Treblle\Core\Support;

use Throwable;

final class PHP
{
    public function get(string $string): string
    {
        try {
            $value = ini_get(option: $string);
            $isBool = filter_var(
                value: $value,
                filter: FILTER_VALIDATE_BOOLEAN,
                options: FILTER_NULL_ON_FAILURE,
            );

            if (is_bool($isBool)) {
                return ($value !== '' && $value !== '0') ? 'On' : 'Off';
            }

            return (string) $value;
        } catch (Throwable) {
        }

        return '<unknown>';
    }
}
