<?php

declare(strict_types=1);

use Treblle\Core\Configuration;

it('can build a new configuration object', function (string $string): void {
    expect(
        new Configuration(
            apiKey: $string,
            projectId: $string,
            ignoredEnvironments: 'dev,local',
            maskedFields: [$string],
        ),
    )->toBeInstanceOf(Configuration::class);
})->with('strings');

it('can convert a configuration object to an array that we expect', function (string $string): void {
    $config = new Configuration(
        apiKey: $string,
        projectId: $string,
        ignoredEnvironments: 'dev,local',
        maskedFields: [$string],
    );

    expect(
        $config->toArray()
    )->toBeArray()->toHaveKeys([
        'api_key',
        'project_id',
        'ignored_environments',
        'masked_fields',
    ]);
})->with('strings');
