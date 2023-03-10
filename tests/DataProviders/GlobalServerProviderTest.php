<?php

declare(strict_types=1);

use Treblle\Core\DataObjects\Server;
use Treblle\Core\DataProviders\GlobalServerProvider;

it('can get a server', function (): void {
    $provider = new GlobalServerProvider();

    expect(
        $provider->get(),
    )->toBeInstanceOf(Server::class);
});
