<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Rest;

use Dbp\Relay\CoreBundle\Rest\AbstractDataProcessor;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Service\DispatchService;

/**
 * @psalm-suppress MissingTemplateParam
 */
class DeliveryStatusChangeProcessor extends AbstractDataProcessor
{
    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    protected function isCurrentUserGrantedOperationAccess(int $operation): bool
    {
        return $this->authorizationService->getCanUse();
    }

    protected function removeItem(mixed $identifier, mixed $data, array $filters): void
    {
        $deliveryStatusChange = $data;
        assert($deliveryStatusChange instanceof DeliveryStatusChange);

        $requestRecipient = $deliveryStatusChange->getDispatchRequestRecipient();
        $requestIdentifier = $requestRecipient->getDispatchRequestIdentifier();
        $request = $this->dispatchService->getRequestById($requestIdentifier);

        $this->authorizationService->checkCanWrite($request->getGroupId());

        $this->dispatchService->removeDeliveryStatusChangeFileById($deliveryStatusChange->getIdentifier());
    }
}
