<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Dbp\Relay\CoreBundle\Rest\CustomControllerTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @psalm-suppress MissingTemplateParam
 */
class DeliveryStatusChangeFileProcessor extends AbstractController implements ProcessorInterface
{
    use CustomControllerTrait;

    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    public function process($data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        $this->requireAuthentication();
        $this->authorizationService->checkCanUse();

        if ($operation instanceof DeleteOperationInterface) {
            $deliveryStatusChange = $data;

            assert($deliveryStatusChange instanceof DeliveryStatusChange);

            $requestRecipient = $deliveryStatusChange->getDispatchRequestRecipient();
            $requestIdentifier = $requestRecipient->getDispatchRequestIdentifier();
            $request = $this->dispatchService->getRequestById($requestIdentifier);

            $this->authorizationService->checkCanWrite($request->getGroupId());

            $this->dispatchService->removeDeliveryStatusChangeFileById($deliveryStatusChange->getIdentifier());
        } else {
            throw new \RuntimeException('not implemented');
        }
    }
}
