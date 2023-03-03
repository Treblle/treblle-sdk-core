<?php

declare(strict_types=1);

use Treblle\Core\DataObjects\Request;

it('can cast an object to an array', function (string $string): void {
    $request = new Request(
        timestamp: $string,
        ip: $string,
        url: $string,
        user_agent: $string,
        method: $string,
        headers: [
            $string => $string,
        ],
        body: [
            $string => $string,
        ],
        raw: [
            $string => $string,
        ],
    );

    expect(
        (array) $request,
    )->toBeArray()->toHaveKeys(
        keys: ['timestamp', 'ip', 'url', 'user_agent', 'method', 'headers', 'body', 'raw'],
    );
})->with('strings');

it('can serialize an object to an array', function (string $string): void {
    $request = new Request(
        timestamp: $string,
        ip: $string,
        url: $string,
        user_agent: $string,
        method: $string,
        headers: [
            $string => $string,
        ],
        body: [
            $string => $string,
        ],
        raw: [
            $string => $string,
        ],
    );

    expect(
        $request->jsonSerialize(),
    )->toBeArray()->toHaveKeys(
        keys: ['timestamp', 'ip', 'url', 'user_agent', 'method', 'headers', 'body', 'raw'],
    );
})->with('strings');

it('can map the object to the correct array format', function (string $string): void {
    $request = new Request(
        timestamp: $string,
        ip: $string,
        url: $string,
        user_agent: $string,
        method: $string,
        headers: [
            $string => $string,
        ],
        body: [
            $string => $string,
        ],
        raw: [
            $string => $string
        ]
    );

    expect(
        $request->__toArray(),
    )->toBeArray()->toEqual([
        'timestamp' => $string,
        'ip' => $string,
        'url' => $string,
        'user_agent' => $string,
        'method' => $string,
        'headers' => [
            $string => $string,
        ],
        'body' => [
            $string => $string,
        ],
        'raw' => [
            $string => $string
        ]
    ]);
})->with('strings');
