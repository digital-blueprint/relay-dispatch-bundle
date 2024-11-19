<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Dbp\Relay\CoreBundle\Rest\CustomControllerTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @implements ProviderInterface<RequestRecipient>
 */
final class RequestRecipientProvider extends AbstractController implements ProviderInterface
{
    use CustomControllerTrait;

    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    /**
     * @return RequestRecipient|array
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if (!$operation instanceof CollectionOperationInterface) {
            $this->requireAuthentication();
            $this->authorizationService->checkCanUse();

            $id = $uriVariables['identifier'];
            assert(is_string($id));
            $requestRecipient = $this->dispatchService->getRequestRecipientById($id);
            $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());
            $this->authorizationService->checkCanReadMetadata($request->getGroupId());

            return $requestRecipient;
        }

        return [];
    }
}
