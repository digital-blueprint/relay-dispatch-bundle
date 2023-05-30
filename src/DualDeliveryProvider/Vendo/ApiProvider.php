<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\ApiProviderInterface;

class ApiProvider implements ApiProviderInterface
{
    public function getDomains(): array
    {
        return ['dual.vendo.at', 'dualtest.vendo.at'];
    }

    public function getPathForOperation(string $operation): ?string
    {
        $mapping = [
            'dualStatusRequestOperation' => '/mprs-polling/services10/DDPollingServiceProcessor',
            'dualDeliveryCancellationRequestOperation' => '/mprs-polling/services10/DDPollingServiceProcessor',
            'dualNotificationRequestOperation' => '/mprs-polling/services10/DDPollingServiceProcessor',
            'dualDeliveryRequestOperation' => '/mprs-core/services10/DDWebServiceProcessor',
            'dualDeliveryPreAddressingRequestOperation' => '/mprs-core/services10/DDAddressingProcessor',
            // Looks like the bulk APIs aren't supported
            'dualNotificationBulkRequestOperation' => null,
            'dualDeliveryBulkRequestOperation' => null,
        ];

        return $mapping[$operation] ?? null;
    }

    public function getStreamContextOptions(): array
    {
        return [
            'ssl' => [
                // vendo gives errors sometimes if 1.3 is used, they recommended restricting to 1.2
                'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
            ],
        ];
    }
}
