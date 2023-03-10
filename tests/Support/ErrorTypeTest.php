<?php

declare(strict_types=1);

use Treblle\Core\Support\ErrorType;

it('can match the error type in PHP to a string value', function (int $error, string $name): void {
    expect(
        ErrorType::get(
            type: $error
        ),
    )->toEqual($name);
})->with('errors');
