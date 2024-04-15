<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @implements ProviderInterface<RequestFile>
 */
final class RequestFileProvider extends AbstractController implements ProviderInterface
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
     * @return RequestFile|RequestFile[]
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        if ($operation instanceof CollectionOperationInterface) {
            return [];
        } else {
            $id = $uriVariables['identifier'];
            assert(is_string($id));
            $requestFile = $this->dispatchService->getRequestFileById($id);
            $request = $this->dispatchService->getRequestById($requestFile->getDispatchRequestIdentifier());
            $this->auth->checkCanReadContent($request->getGroupId());

            return $requestFile;
        }
    }
}
