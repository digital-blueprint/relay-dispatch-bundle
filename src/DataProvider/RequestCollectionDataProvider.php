<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\CoreBundle\Helpers\ArrayFullPaginator;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class RequestCollectionDataProvider extends AbstractController implements CollectionDataProviderInterface, RestrictedDataProviderInterface
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

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): ArrayFullPaginator
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_SCOPE_DISPATCH');

        $perPage = 30;
        $page = 1;

        $filters = $context['filters'] ?? [];

        if (isset($filters['page'])) {
            $page = (int) $filters['page'];
        }
        if (isset($filters['perPage'])) {
            $perPage = (int) $filters['perPage'];
        }

        return new ArrayFullPaginator(
            $this->dispatchService->getRequestsForCurrentPerson(),
            $page,
            $perPage);
    }
}
