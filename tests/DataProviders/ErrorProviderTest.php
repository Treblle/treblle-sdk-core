<?php

declare(strict_types=1);

use Treblle\Core\DataObjects\Error;
use Treblle\Core\DataProviders\ErrorProvider;

it('can add an error to the error provider', function (string $string): void {
    $provider = new ErrorProvider();

    expect(
        $provider->get(),
    )->toBeArray()->toBeEmpty();

    $provider->add(
        error: new Error(
            source: $string,
            type: $string,
            message: $string,
            file: $string,
            line: 123,
        ),
    );

    expect(
        $provider->get(),
    )->toBeArray()->toHaveCount(1);
})->with('strings');
