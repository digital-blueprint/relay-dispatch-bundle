<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Dbp\Relay\CoreBundle\Rest\CustomControllerTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @implements ProviderInterface<DeliveryStatusChange>
 */
final class DeliveryStatusChangeFileProvider extends AbstractController implements ProviderInterface
{
    use CustomControllerTrait;

    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    /**
     * @return DeliveryStatusChange|array
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if (!$operation instanceof CollectionOperationInterface) {
            $this->requireAuthentication();
            $this->authorizationService->checkCanUse();

            $id = $uriVariables['identifier'];
            assert(is_string($id));
            $deliveryStatusChange = $this->dispatchService->getDeliveryStatusChangeById($id);

            $requestRecipient = $this->dispatchService->getRequestRecipientById($deliveryStatusChange->getDispatchRequestRecipientIdentifier());
            $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());
            $this->authorizationService->checkCanReadMetadata($request->getGroupId());

            return $deliveryStatusChange;
        }

        return [];
    }
}
