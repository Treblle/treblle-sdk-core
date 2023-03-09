<?php

declare(strict_types=1);

namespace Treblle\Core\DataProviders;

use Treblle\Core\Contracts\DataProviders\ErrorContract;
use Treblle\Core\DataObjects\Error;

final class ErrorProvider implements ErrorContract
{
    /**
     * @param list<Error> $errors
     */
    public function __construct(
        private array $errors,
    ) {
    }

    /**
     * @return Error[]
     */
    public function get(): array
    {
        return $this->errors;
    }

    /**
     * @param Error $error
     * @return void
     */
    public function add(Error $error): void
    {
        $this->errors[] = $error;
    }
}
