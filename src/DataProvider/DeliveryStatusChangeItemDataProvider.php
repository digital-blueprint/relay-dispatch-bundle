<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DeliveryStatusChangeItemDataProvider extends AbstractController implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var DispatchService
     */
    private $dispatchService;
    /**
     * @var AuthorizationService
     */
    private $auth;

    public function __construct(DispatchService $dispatchService, AuthorizationService $auth)
    {
        $this->dispatchService = $dispatchService;
        $this->auth = $auth;
    }

    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return DeliveryStatusChange::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, ?string $operationName = null, array $context = []): ?DeliveryStatusChange
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        $deliveryStatusChange = $this->dispatchService->getDeliveryStatusChangeById($id);
        $requestRecipient = $this->dispatchService->getRequestRecipientById($deliveryStatusChange->getDispatchRequestRecipientIdentifier());
        $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());

        $this->auth->checkCanReadMetadata($request->getGroupId());

        return $deliveryStatusChange;
    }
}
