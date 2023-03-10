<?php

declare(strict_types=1);

use Treblle\Core\Configuration;
use Treblle\Core\DataProviders\ErrorProvider;
use Treblle\Core\DataProviders\GlobalRequestProvider;
use Treblle\Core\DataProviders\GlobalServerProvider;
use Treblle\Core\DataProviders\LanguageProvider;
use Treblle\Core\DataProviders\OutputBufferResponseProvider;
use Treblle\Core\Handlers\NullShutdownHandler;
use Treblle\Core\Masking\FieldMasker;
use Treblle\Core\Support\PHP;
use Treblle\Core\Treblle;

beforeEach(fn () => $this->treblle = new Treblle(
    configuration: new Configuration(
        apiKey: '123123',
        projectId: '12341234',
        ignoredEnvironments: 'dev,local',
        maskedFields: ['password'],
    ),
    server: new GlobalServerProvider(),
    language: new LanguageProvider(
        php: new PHP(),
    ),
    request: new GlobalRequestProvider(
        masker: $masker = new FieldMasker(
            fields: ['password'],
        ),
    ),
    response: new OutputBufferResponseProvider(
        error: $error = new ErrorProvider(),
        masker: $masker,
    ),
    error: $error,
    handler: new NullShutdownHandler(),
    debug: true,
));

it('can build a new instance', function (): void {
    expect(
        $this->treblle,
    )->toBeInstanceOf(Treblle::class);
});

it('can get the SDK name', function (): void {
    expect(
        $this->treblle->name(),
    )->toEqual('php');
});

it('can get the SDK version', function (): void {
    expect(
        $this->treblle->version(),
    )->toEqual(0.8);
});

it('can get errors onError', function (string $string): void {
    expect(
        $this->treblle->error->get(),
    )->toBeArray()->toBeEmpty();

    $this->treblle->onError(
        type: E_STRICT,
        message: $string,
        file: $string,
        line: 123,
    );

    expect(
        $this->treblle->error->get(),
    )->toBeArray()->toHaveCount(1);
})->with('strings');

it('throws an exception if fails to add error onError', function (string $string): void {
    expect(
        $this->treblle->error->get(),
    )->toBeArray()->toBeEmpty();

    $this->treblle->onError(
        type: 1234,
        message: $string,
        file: $string,
        line: 123,
    );
})->with('strings')->throws(InvalidArgumentException::class);

it('can get errors onException', function (string $string): void {
    expect(
        $this->treblle->error->get(),
    )->toBeArray()->toBeEmpty();

    $this->treblle->onException(
        exception: new RuntimeException(),
    );

    expect(
        $this->treblle->error->get(),
    )->toBeArray()->toHaveCount(1);
})->with('strings');

it('throws an exception if fails to add error onException', function (string $string): void {
    expect(
        $this->treblle->error->get(),
    )->toBeArray()->toBeEmpty();

    $this->treblle->onException(
        exception: new RuntimeException(),
    );
})->with('strings');

it('can handle the onShutdown call', function (): void {
    expect(
        $this->treblle->error->get(),
    )->toBeArray()->toBeEmpty();

    expect(
        $this->treblle->onShutdown(),
    )->toBeNull();
});

it('throws an exception if the handler fails on the onShutdown call', function (): void {
    expect(
        $this->treblle->error->get(),
    )->toBeArray()->toBeEmpty();

    $this->treblle->handler = new class () implements \Treblle\Core\Contracts\Http\ShutdownHandlerContract {
        public function handle(array $payload, Configuration $configuration): mixed
        {
            throw new RuntimeException();
        }
    };

    $this->treblle->onShutdown();
})->throws(RuntimeException::class);

it('can build a payload', function (): void {
    expect(
        $this->treblle->buildPayload(),
    )->toBeArray()->toHaveKeys(
        keys: ['api_key', 'project_id', 'version', 'sdk', 'data'],
    );
});
