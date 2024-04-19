<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @implements ProviderInterface<DeliveryStatusChange>
 */
final class DeliveryStatusChangeProvider extends AbstractController implements ProviderInterface
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

    /**
     * @return DeliveryStatusChange|array
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if (!$operation instanceof CollectionOperationInterface) {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $this->auth->checkCanUse();

            $id = $uriVariables['identifier'];
            assert(is_string($id));
            $deliveryStatusChange = $this->dispatchService->getDeliveryStatusChangeById($id);
            $requestRecipient = $this->dispatchService->getRequestRecipientById($deliveryStatusChange->getDispatchRequestRecipientIdentifier());
            $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());

            $this->auth->checkCanReadMetadata($request->getGroupId());

            return $deliveryStatusChange;
        }

        return [];
    }
}
