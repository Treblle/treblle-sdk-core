<?php

declare(strict_types=1);

namespace Treblle\Core\Contracts\DataProviders;

use Treblle\Core\DataObjects\Response;

interface ResponseContract
{
    /**
     * @return Response
     */
    public function get(): Response;
}
