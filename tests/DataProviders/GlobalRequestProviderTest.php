<?php

declare(strict_types=1);

use Treblle\Core\DataObjects\Request;
use Treblle\Core\DataProviders\GlobalRequestProvider;
use Treblle\Core\Masking\FieldMasker;

it('can get a request', function (): void {
    $provider = new GlobalRequestProvider(
        masker: new FieldMasker(
            fields: ['password'],
        ),
    );

    expect(
        $provider->get(),
    )->toBeInstanceOf(Request::class);
});
