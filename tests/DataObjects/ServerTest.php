<?php

declare(strict_types=1);

use Treblle\Core\DataObjects\OS;
use Treblle\Core\DataObjects\Server;

it('can cast an object to an array', function (string $string): void {
    $server = new Server(
        ip: $string,
        timezone: $string,
        software: $string,
        signature: $string,
        protocol: $string,
        os: new OS(
            name: $string,
            release: $string,
            architecture: $string,
        ),
        encoding: $string,
    );

    expect(
        (array) $server,
    )->toBeArray()->toHaveKeys(
        keys: ['ip', 'timezone', 'software', 'signature', 'protocol', 'os', 'encoding']
    );
})->with('strings');

it('can serialize an object to an array', function (string $string): void {
    $server = new Server(
        ip: $string,
        timezone: $string,
        software: $string,
        signature: $string,
        protocol: $string,
        os: new OS(
            name: $string,
            release: $string,
            architecture: $string,
        ),
        encoding: $string,
    );

    expect(
        $server->jsonSerialize(),
    )->toBeArray()->toHaveKeys(
        keys: ['ip', 'timezone', 'software', 'signature', 'protocol', 'os', 'encoding']
    );
})->with('strings');

it('can map the object to the correct array format', function (string $string): void {
    $server = new Server(
        ip: $string,
        timezone: $string,
        software: $string,
        signature: $string,
        protocol: $string,
        os: new OS(
            name: $string,
            release: $string,
            architecture: $string,
        ),
        encoding: $string,
    );

    expect(
        $server->__toArray(),
    )->toBeArray()->toEqual([
        'ip' => $string,
        'timezone' => $string,
        'software' => $string,
        'signature' => $string,
        'protocol' => $string,
        'os' => [
            'name' => $string,
            'release' => $string,
            'architecture' => $string,
        ],
        'encoding' => $string,
    ]);
})->with('strings');
