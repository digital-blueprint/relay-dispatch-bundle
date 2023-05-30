<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi;

/**
 * This gets used if no other provider matches.
 */
class FallbackApiProvider implements ApiProviderInterface
{
    public function getDomains(): array
    {
        return [];
    }

    public function getPathForOperation(string $operation): ?string
    {
        return '';
    }

    public function getStreamContextOptions(): array
    {
        return [];
    }
}
