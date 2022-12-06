<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class RequestFileItemDataProvider extends AbstractController implements ItemDataProviderInterface, RestrictedDataProviderInterface
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

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return RequestFile::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?RequestFile
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $filters = $context['filters'] ?? [];

        $requestFile = $this->dispatchService->getRequestFileById($id);
        $request = $this->dispatchService->getRequestById($requestFile->getDispatchRequestIdentifier());
        $this->auth->checkCanReadMetadata($request->getGroupId());

        return $requestFile;
    }
}
