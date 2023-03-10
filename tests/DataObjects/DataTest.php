<?php

declare(strict_types=1);

use Treblle\Core\DataObjects\Data;
use Treblle\Core\DataObjects\Language;
use Treblle\Core\DataObjects\OS;
use Treblle\Core\DataObjects\Request;
use Treblle\Core\DataObjects\Response;
use Treblle\Core\DataObjects\Server;
use Treblle\Core\Http\Method;

it('can cast an object to an array', function (string $string): void {
    $data = new Data(
        server: new Server(
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
            encoding: $string
        ),
        language: new Language(
            name: $string,
            version: $string,
            expose_php: $string,
            display_errors: $string,
        ),
        request: new Request(
            timestamp: $string,
            ip: $string,
            url: $string,
            user_agent: $string,
            method: Method::GET,
            headers: [
                $string => $string,
            ],
            body: [
                $string => $string,
            ],
            raw: [
                $string => $string,
            ],
        ),
        response: new Response(
            headers: [
                $string => $string,
            ],
            code: 123,
            size: 123,
            load_time: 12.3,
            body: [
                $string => $string,
            ],
        ),
        errors: [
            new \Treblle\Core\DataObjects\Error(
                source: $string,
                type: $string,
                message: $string,
                file: $string,
                line: 123,
            ),
        ],
    );

    expect(
        (array) $data,
    )->toBeArray()->toHaveKeys(
        keys: ['server', 'language', 'request', 'response', 'errors'],
    );
})->with('strings');

it('can serialize an object to an array', function (string $string): void {
    $data = new Data(
        server: new Server(
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
            encoding: $string
        ),
        language: new Language(
            name: $string,
            version: $string,
            expose_php: $string,
            display_errors: $string,
        ),
        request: new Request(
            timestamp: $string,
            ip: $string,
            url: $string,
            user_agent: $string,
            method: Method::GET,
            headers: [
                $string => $string,
            ],
            body: [
                $string => $string,
            ],
            raw: [
                $string => $string,
            ],
        ),
        response: new Response(
            headers: [
                $string => $string,
            ],
            code: 123,
            size: 123,
            load_time: 12.3,
            body: [
                $string => $string,
            ],
        ),
        errors: [
            new \Treblle\Core\DataObjects\Error(
                source: $string,
                type: $string,
                message: $string,
                file: $string,
                line: 123,
            ),
        ],
    );

    expect(
        $data->jsonSerialize(),
    )->toBeArray()->toHaveKeys(
        keys: ['server', 'language', 'request', 'response', 'errors'],
    );
})->with('strings');

it('can map the object to the correct array format', function (string $string): void {
    $data = new Data(
        server: new Server(
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
            encoding: $string
        ),
        language: new Language(
            name: $string,
            version: $string,
            expose_php: $string,
            display_errors: $string,
        ),
        request: new Request(
            timestamp: $string,
            ip: $string,
            url: $string,
            user_agent: $string,
            method: Method::GET,
            headers: [
                $string => $string,
            ],
            body: [
                $string => $string,
            ],
            raw: [
                $string => $string,
            ],
        ),
        response: new Response(
            headers: [
                $string => $string,
            ],
            code: 123,
            size: 123,
            load_time: 12.3,
            body: [
                $string => $string,
            ],
        ),
        errors: [
            new \Treblle\Core\DataObjects\Error(
                source: $string,
                type: $string,
                message: $string,
                file: $string,
                line: 123,
            ),
        ],
    );

    expect(
        $data->__toArray(),
    )->toBeArray()->toEqual([
        'server' => [
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
        ],
        'language' => [
            'name' => $string,
            'version' => $string,
            'expose_php' => $string,
            'display_errors' => $string
        ],
        'request' => [
            'timestamp' => $string,
            'ip' => $string,
            'url' => $string,
            'user_agent' => $string,
            'method' => Method::GET->value,
            'headers' => [
                $string => $string,
            ],
            'body' => [
                $string => $string,
            ],
            'raw' => [
                $string => $string,
            ],
        ],
        'response' => [
            'headers' => [
                $string => $string,
            ],
            'code' => 123,
            'size' => 123,
            'load_time' => 12.3,
            'body' => [
                $string => $string,
            ]
        ],
        'errors' => [
            [
                'source' => $string,
                'type' => $string,
                'message' => $string,
                'file' => $string,
                'line' => 123,
            ]
        ]
    ]);
})->with('strings');
