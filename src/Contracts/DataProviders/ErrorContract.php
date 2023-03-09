<?php

declare(strict_types=1);

namespace Treblle\Core\Contracts\DataProviders;

use Treblle\Core\DataObjects\Error;

interface ErrorContract
{
    /**
     * @return list<Error>
     */
    public function get(): array;

    /**
     * @param Error $error
     * @return void
     */
    public function add(Error $error): void;
}
