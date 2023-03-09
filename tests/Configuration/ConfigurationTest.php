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
