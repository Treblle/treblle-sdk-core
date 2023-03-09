<?php

declare(strict_types=1);

namespace Treblle\Core;

use Treblle\Core\Contracts\DataProviders\ErrorContract;
use Treblle\Core\Contracts\DataProviders\LanguageContract;
use Treblle\Core\Contracts\DataProviders\RequestContract;
use Treblle\Core\Contracts\DataProviders\ResponseContract;
use Treblle\Core\Contracts\DataProviders\ServerContract;

final class Treblle
{
    private const SDK_VERSION = 0.8;
    private const SDK_NAME = 'php';

    public function __construct(
        private readonly Configuration $configuration,
        private readonly ServerContract $server,
        private readonly LanguageContract $language,
        private readonly RequestContract $request,
        private readonly ResponseContract $response,
        private readonly ErrorContract $error,
        private readonly bool $debug = false,
    ) {
    }
}
