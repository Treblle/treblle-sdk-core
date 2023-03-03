<?php

declare(strict_types=1);

namespace Treblle\Core\DataObjects;

use Treblle\Core\Concerns\CanBeSerialized;
use Treblle\Core\Contracts\DataObjects\TreblleObject;

final class Request implements TreblleObject
{
    use CanBeSerialized;

    /**
     * @param string $timestamp The timestamp of the request in the format: YYYY-MM-DD hh:mm:ss.
     * @param string $ip The real IP address of the request.
     * @param string $url The full URL of the request including query data if any.
     * @param string $user_agent The User Agent of the request.
     * @param string $method The HTTP method of the request, uppercase if possible.
     * @param array<string,string> $headers The request headers for the request in key:value format.
     * @param array<int|string,mixed> $body The complete request data sent with this request.
     * @param array<int|string,mixed> $raw The raw body from the request.
     */
    public function __construct(
        public readonly string $timestamp,
        public readonly string $ip,
        public readonly string $url,
        public readonly string $user_agent,
        public readonly string $method,
        public readonly array $headers,
        public readonly array $body,
        public readonly array $raw,
    ) {
    }

    /**
     * @return array{
     *     timestamp: string,
     *     ip: string,
     *     url: string,
     *     user_agent: string,
     *     method: string,
     *     headers: array,
     *     body: array,
     *     raw: array,
     * }
     */
    public function __toArray(): array
    {
        return [
            'timestamp' => $this->timestamp,
            'ip' => $this->ip,
            'url' => $this->url,
            'user_agent' => $this->user_agent,
            'method' => $this->method,
            'headers' => $this->headers,
            'body' => $this->body,
            'raw' => $this->raw,
        ];
    }
}
