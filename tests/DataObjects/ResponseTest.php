<?php

declare(strict_types=1);

use Treblle\Core\DataObjects\Response;

it('can cast an object to an array', function (string $string): void {
    $response = new Response(
        headers: [
            $string => $string,
        ],
        code: 123,
        size: 123,
        load_time: 12.3,
        body: [
            $string => $string,
        ],
    );

    expect(
        (array) $response,
    )->toBeArray()->toHaveKeys(
        keys: ['headers', 'code', 'size', 'load_time', 'body'],
    );
})->with('strings');

it('can serialize an object to an array', function (string $string): void {
    $response = new Response(
        headers: [
            $string => $string,
        ],
        code: 123,
        size: 123,
        load_time: 12.3,
        body: [
            $string => $string,
        ],
    );

    expect(
        $response->jsonSerialize(),
    )->toBeArray()->toHaveKeys(
        keys: ['headers', 'code', 'size', 'load_time', 'body'],
    );
})->with('strings');

it('can map the object to the correct array format', function (string $string): void {
    $response = new Response(
        headers: [
            $string => $string,
        ],
        code: 123,
        size: 123,
        load_time: 12.3,
        body: [
            $string => $string,
        ]
    );

    expect(
        $response->__toArray(),
    )->toBeArray()->toEqual([
        'headers' => [
            $string => $string,
        ],
        'code' => 123,
        'size' => 123,
        'load_time' => 12.3,
        'body' => [
            $string => $string,
        ],
    ]);
})->with('strings');
