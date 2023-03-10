<?php

declare(strict_types=1);

use Treblle\Core\DataProviders\LanguageProvider;
use Treblle\Core\Support\PHP;

it('can get the language from the provider', function (): void {
    $provider = new LanguageProvider(
        php: new PHP(),
    );

    $php = $provider->get();

    expect(
        $php->name
    )->toEqual('php')->and(
        $php->version
    )->toEqual(PHP_VERSION);
});
