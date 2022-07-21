<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class RequestItemDataProvider extends AbstractController implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var DispatchService
     */
    private $dispatchService;

    public function __construct(DispatchService $dispatchService)
    {
        $this->dispatchService = $dispatchService;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Request::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Request
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_SCOPE_DISPATCH');

        $filters = $context['filters'] ?? [];

        return $this->dispatchService->getRequestByIdForCurrentPerson($id);
    }
}
