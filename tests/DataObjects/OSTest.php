<?php

declare(strict_types=1);

use Treblle\Core\DataObjects\OS;

it('can cast an object to an array', function (string $string): void {
    $os = new OS(
        name: $string,
        release: $string,
        architecture: $string,
    );

    expect(
        (array) $os,
    )->toBeArray()->toHaveKeys(
        keys: ['name', 'release', 'architecture'],
    );
})->with('strings');

it('can serialize an object to an array', function (string $string): void {
    $os = new OS(
        name: $string,
        release: $string,
        architecture: $string,
    );

    expect(
        $os->jsonSerialize(),
    )->toBeArray()->toHaveKeys(
        keys: ['name', 'release', 'architecture'],
    );
})->with('strings');

it('can map the object to the correct array format', function (string $string): void {
    $os = new OS(
        name: $string,
        release: $string,
        architecture: $string
    );

    expect(
        $os->__toArray(),
    )->toBeArray()->toEqual([
        'name' => $string,
        'release' => $string,
        'architecture' => $string,
    ]);
})->with('strings');
