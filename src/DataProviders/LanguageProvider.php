<?php

declare(strict_types=1);

namespace Treblle\Core\DataProviders;

use Treblle\Core\Contracts\DataProviders\LanguageContract;
use Treblle\Core\DataObjects\Language;
use Treblle\Core\Support\PHP;

final class LanguageProvider implements LanguageContract
{
    public function __construct(
        private PHP $php,
    ) {
    }

    public function get(): Language
    {
        return new Language(
            name: 'php',
            version: PHP_VERSION,
            expose_php: $this->php->get(
                string: 'expose_php',
            ),
            display_errors: $this->php->get(
                string: 'display_errors',
            ),
        );
    }
}
