<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class RequestItemDataProvider extends AbstractController implements ItemDataProviderInterface, RestrictedDataProviderInterface
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
        return Request::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Request
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $filters = $context['filters'] ?? [];

        $request = $this->dispatchService->getRequestById($id);
        $groupId = $request->getGroupId();
        $this->auth->checkCanReadMetadata($groupId);

        // If the user can't read the content, hide the files and the name
        if (!$this->auth->getCanReadContent($groupId)) {
            $request->setFiles([]);
            $request->setName('');
        }

        return $request;
    }
}
