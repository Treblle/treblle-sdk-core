<?php

declare(strict_types=1);

namespace Treblle\Core;

final class Configuration
{
    /**
     * @param string $apiKey
     * @param string $projectId
     * @param string $ignoredEnvironments
     * @param array<int,string> $maskedFields
     */
    public function __construct(
        public readonly string $apiKey,
        public readonly string $projectId,
        public readonly string $ignoredEnvironments,
        public readonly array $maskedFields,
    ) {
    }

    /**
     * @return array<string,string|array<int,string>>
     */
    public function toArray(): array
    {
        return [
            'api_key' => $this->apiKey,
            'project_id' => $this->projectId,
            'ignored_environments' => $this->ignoredEnvironments,
            'masked_fields' => $this->maskedFields,
        ];
    }
}
