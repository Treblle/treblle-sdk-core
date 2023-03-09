<?php

declare(strict_types=1);

namespace Treblle\Core\Masking;

use Treblle\Core\Contracts\Masking\MaskingContract;

final class FieldMasker implements MaskingContract
{
    public function __construct(
        public array $fields,
    ) {
    }

    /**
     * @param array<string,string|array> $data
     * @return array
     */
    public function mask(array $data): array
    {
        $collector = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $collector[$key] = $this->mask(
                    data: $value,
                );
            }

            // we should know it is a string.
            if (is_string($value)) {
                // check if this is an auth header or api key header etc
                // is the key a header we want to mask?
                if ($this->isHeader(
                    name: $key,
                )) {
                    // grab the sensitive part of the value and mask.
                    if ($this->isAuth(
                        value: $value,
                    )) {
                        $parts = explode(
                            separator: ' ',
                            string: $value,
                        );

                        $parts[1] = $this->star(
                            string: $parts[1],
                        );

                        $value = implode(' ', $parts);
                    } else {
                        $value = $this->star(
                            string: $value,
                        );
                    }
                }

                if (in_array($key, $this->fields, true)) {
                    $collector[$key] = $this->star(
                        string: $value,
                    );
                } else {
                    $collector[$key] = $value;
                }
            }
        }

        return $collector;
    }

    private function isHeader(string $name): bool
    {
        return in_array(
            needle: $name,
            haystack: [
                'auth',
                'Auth',
                'Authorization',
                'authorization',
                'X-API-KEY',
                'x-api-key',
            ],
            strict: true,
        );
    }

    private function isAuth(string $value): bool
    {
        return in_array(
            needle: explode(
                separator: ' ',
                string: $value,
            )[0],
            haystack: [
                'Bearer',
                'bearer',
                'Basic',
                'basic',
            ],
            strict: true,
        );
    }

    public function star(string $string): string
    {
        return str_repeat(
            string: '*',
            times: strlen(
                string: $string,
            ),
        );
    }
}
