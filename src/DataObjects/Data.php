<?php

declare(strict_types=1);

namespace Treblle\Core\DataObjects;

use Treblle\Core\Concerns\CanBeSerialized;
use Treblle\Core\Contracts\DataObjects\TreblleObject;

final class Data implements TreblleObject
{
    use CanBeSerialized;

    /**
     * @param Server $server The Server Object.
     * @param Language $language The Language Object.
     * @param Request $request The Request Object.
     * @param Response $response The Response Object.
     * @param list<Error> $errors The list of Errors.
     */
    public function __construct(
        public Server $server,
        public Language $language,
        public Request $request,
        public Response $response,
        public array $errors,
    ) {
    }

    /**
     * @return array{
     *     server: array,
     *     language: array,
     *     request: array,
     *     response: array,
     *     errors: array,
     * }
     */
    public function __toArray(): array
    {
        return [
            'server' => $this->server->__toArray(),
            'language' => $this->language->__toArray(),
            'request' => $this->request->__toArray(),
            'response' => $this->response->__toArray(),
            'errors' => array_map(
                callback: static fn ($error): array => $error->__toArray(),
                array: $this->errors,
            ),
        ];
    }
}
