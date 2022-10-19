<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\CoreBundle\Helpers\ArrayFullPaginator;
use Dbp\Relay\DispatchBundle\Entity\Group;
use Dbp\Relay\DispatchBundle\Service\GroupService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class GroupCollectionDataProvider extends AbstractController implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var GroupService
     */
    private $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Group::class === $resourceClass;
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
            $this->groupService->getGroups(),
            $page,
            $perPage);
    }
}
