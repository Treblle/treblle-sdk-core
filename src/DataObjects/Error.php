<?php

declare(strict_types=1);

namespace Treblle\Core\DataObjects;

use Treblle\Core\Concerns\CanBeSerialized;
use Treblle\Core\Contracts\DataObjects\TreblleObject;

final class Error implements TreblleObject
{
    use CanBeSerialized;

    /**
     * @param string|null $source The reason an error is thrown, onException, onError, onShutdown.
     * @param string|string $type The error type for the language.
     * @param string|null $message The error message give.
     * @param string|null $file The name of the file that caused the error.
     * @param int|null $line The exact line of code where the error happened.
     */
    public function __construct(
        public null|string $source,
        public null|string $type,
        public null|string $message,
        public null|string $file,
        public null|int $line,
    ) {
    }

    /**
     * @return array{
     *     source: null|string,
     *     type: null|string,
     *     message: null|string,
     *     file: null|string,
     *     line: null|int,
     * }
     */
    public function __toArray(): array
    {
        return [
            'source' => $this->source,
            'type' => $this->type,
            'message' => $this->message,
            'file' => $this->file,
            'line' => $this->line,
        ];
    }
}
