<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Rest;

use Dbp\Relay\CoreBundle\Rest\AbstractDataProvider;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Service\DispatchService;

/**
 * @extends AbstractDataProvider<DeliveryStatusChange>
 */
final class DeliveryStatusChangeProvider extends AbstractDataProvider
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

    protected function getItemById(string $id, array $filters = [], array $options = []): ?DeliveryStatusChange
    {
        $deliveryStatusChange = $this->dispatchService->getDeliveryStatusChangeById($id);
        if ($deliveryStatusChange !== null) {
            $requestRecipient = $this->dispatchService->getRequestRecipientById($deliveryStatusChange->getDispatchRequestRecipientIdentifier());
            $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());
            $this->authorizationService->checkCanReadMetadata($request->getGroupId());
        }

        return $deliveryStatusChange;
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        throw new \RuntimeException('not implemented');
    }
}
