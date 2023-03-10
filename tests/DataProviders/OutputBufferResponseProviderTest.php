<?php

declare(strict_types=1);

use Treblle\Core\DataObjects\Response;
use Treblle\Core\DataProviders\ErrorProvider;
use Treblle\Core\DataProviders\OutputBufferResponseProvider;
use Treblle\Core\Masking\FieldMasker;

it('can get a response', function (): void {
    $provider = new OutputBufferResponseProvider(
        error: new ErrorProvider(),
        masker: new FieldMasker(
            fields: ['password'],
        ),
    );

    expect(
        $provider->get(),
    )->toBeInstanceOf(Response::class);
});
