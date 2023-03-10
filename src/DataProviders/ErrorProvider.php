<?php

declare(strict_types=1);

namespace Treblle\Core\DataProviders;

use InvalidArgumentException;
use Treblle\Core\Contracts\DataProviders\ErrorContract;
use Treblle\Core\DataObjects\Error;

final class ErrorProvider implements ErrorContract
{
    /**
     * @param list<Error> $errors
     */
    public function __construct(
        private array $errors = [],
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
        if (
            str_contains(haystack: (string) $error->type, needle: 'Unknown')
            || str_contains(haystack: (string) $error->type, needle: 'null')
        ) {
            throw new InvalidArgumentException(
                message: "Unsupported Error Type: $error->type",
            );
        }

        $this->errors[] = $error;
    }
}
