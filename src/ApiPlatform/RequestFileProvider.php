<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Dbp\Relay\CoreBundle\Rest\CustomControllerTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @implements ProviderInterface<RequestFile>
 */
final class RequestFileProvider extends AbstractController implements ProviderInterface
{
    use CustomControllerTrait;

    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    /**
     * @return RequestFile|RequestFile[]
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $this->requireAuthentication();
        $this->authorizationService->checkCanUse();

        if ($operation instanceof CollectionOperationInterface) {
            return [];
        } else {
            $id = $uriVariables['identifier'];
            assert(is_string($id));
            $requestFile = $this->dispatchService->getRequestFileById($id);
            $request = $this->dispatchService->getRequestById($requestFile->getDispatchRequestIdentifier());
            $this->authorizationService->checkCanReadContent($request->getGroupId());

            return $requestFile;
        }
    }
}
