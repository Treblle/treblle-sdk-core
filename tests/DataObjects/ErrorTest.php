<?php

declare(strict_types=1);

use Treblle\Core\DataObjects\Error;

it('can cast an object to an array', function (string $string): void {
    $error = new Error(
        source: $string,
        type: $string,
        message: $string,
        file: $string,
        line: 1,
    );

    expect(
        (array) $error,
    )->toBeArray()->toHaveKeys(
        keys: ['source', 'type', 'message', 'file', 'line'],
    );
})->with('strings');

it('can serialize an object to an array', function (string $string): void {
    $error = new Error(
        source: $string,
        type: $string,
        message: $string,
        file: $string,
        line: 1,
    );

    expect(
        $error->jsonSerialize(),
    )->toBeArray()->toHaveKeys(
        keys: ['source', 'type', 'message', 'file', 'line'],
    );
})->with('strings');

it('can map the object to the correct array format', function (string $string): void {
    $error = new Error(
        source: $string,
        type: $string,
        message: $string,
        file: $string,
        line: 123,
    );

    expect(
        $error->__toArray(),
    )->toBeArray()->toEqual([
        'source' => $string,
        'type' => $string,
        'message' => $string,
        'file' => $string,
        'line' => 123,
    ]);
})->with('strings');
