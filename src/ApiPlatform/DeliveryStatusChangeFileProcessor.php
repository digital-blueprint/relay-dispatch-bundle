<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @psalm-suppress MissingTemplateParam
 */
class DeliveryStatusChangeFileProcessor extends AbstractController implements ProcessorInterface
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
     * @return void
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        if ($operation instanceof DeleteOperationInterface) {
            $deliveryStatusChange = $data;

            assert($deliveryStatusChange instanceof DeliveryStatusChange);

            $requestRecipient = $deliveryStatusChange->getDispatchRequestRecipient();
            $requestIdentifier = $requestRecipient->getDispatchRequestIdentifier();
            $request = $this->dispatchService->getRequestById($requestIdentifier);

            $this->auth->checkCanWrite($request->getGroupId());

            $this->dispatchService->removeDeliveryStatusChangeFileById($deliveryStatusChange->getIdentifier());
        } else {
            throw new \RuntimeException('not implemented');
        }
    }
}
