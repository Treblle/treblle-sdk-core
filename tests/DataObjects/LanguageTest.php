<?php

declare(strict_types=1);

use Treblle\Core\DataObjects\Language;

it('can cast an object to an array', function (string $string): void {
    $language = new Language(
        name: $string,
        version: $string,
        expose_php: $string,
        display_errors: $string,
    );

    expect(
        (array) $language,
    )->toBeArray()->toHaveKeys(
        keys: ['name', 'version', 'expose_php', 'display_errors'],
    );
})->with('strings');

it('can serialize an object to an array', function (string $string): void {
    $language = new Language(
        name: $string,
        version: $string,
        expose_php: $string,
        display_errors: $string,
    );

    expect(
        $language->jsonSerialize(),
    )->toBeArray()->toHaveKeys(
        keys: ['name', 'version', 'expose_php', 'display_errors'],
    );
})->with('strings');

it('can map the object to the correct array format', function (string $string): void {
    $language = new Language(
        name: $string,
        version: $string,
        expose_php: $string,
        display_errors: $string,
    );

    expect(
        $language->__toArray(),
    )->toBeArray()->toEqual([
        'name' => $string,
        'version' => $string,
        'expose_php' => $string,
        'display_errors' => $string,
    ]);
})->with('strings');
