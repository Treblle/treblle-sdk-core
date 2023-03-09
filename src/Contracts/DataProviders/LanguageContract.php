<?php

declare(strict_types=1);

namespace Treblle\Core\Contracts\DataProviders;

use Treblle\Core\DataObjects\Language;

interface LanguageContract
{
    /**
     * @return Language
     */
    public function get(): Language;
}
