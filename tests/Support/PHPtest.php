<?php

declare(strict_types=1);

use Treblle\Core\Support\PHP;

it('can get init values', function (): void {
    $php = new PHP();

    expect(
        $php->get(
            string: 'display_errors',
        ),
    )->toBeString()->toEqual(ini_get('display_errors'));

    expect(
        $php->get(
            string: 'oops',
        ),
    )->toBeString()->toEqual('<unknown>');

    expect(
        $php->get(
            string: 'memory_limit',
        ),
    )->toBeString()->toEqual(ini_get('memory_limit'));
});
