<?php

declare(strict_types=1);

namespace Treblle\Core\Contracts\DataProviders;

use Treblle\Core\DataObjects\Request;

interface RequestContract
{
    /**
     * @return Request
     */
    public function get(): Request;
}
