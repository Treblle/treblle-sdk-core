<?php

declare(strict_types=1);

use Treblle\Core\Handlers\NullShutdownHandler;

it('can call the shutdown handler', function (): void {
    expect(
        (new NullShutdownHandler())->handle(
            payload: [],
            configuration: new \Treblle\Core\Configuration(
                apiKey: '123',
                projectId: '123',
                ignoredEnvironments: 'dev,local',
                maskedFields: ['password'],
            ),
        ),
    )->toBeNull();
});
