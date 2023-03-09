<?php

declare(strict_types=1);

namespace Treblle\Core\Http;

enum Endpoint: string
{
    case ROCK_N_ROLLA = 'https://rocknrolla.treblle.com';
    case PUNISHER = 'https://punisher.treblle.com';
    case SICARIO = 'https://sicario.treblle.com';
}
