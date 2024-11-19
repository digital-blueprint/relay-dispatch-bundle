<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use Dbp\Relay\CoreBundle\Rest\AbstractDataProvider;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Group;
use Dbp\Relay\DispatchBundle\Service\GroupService;

/**
 * @extends AbstractDataProvider<Group>
 */
class GroupProvider extends AbstractDataProvider
{
    public function __construct(
        private readonly GroupService $groupService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    protected function isUserGrantedOperationAccess(int $operation): bool
    {
        return $this->isAuthenticated();
    }

    protected function getItemById($id, array $filters = [], array $options = []): object
    {
        $this->authorizationService->checkCanUse();
        $this->authorizationService->checkCanReadMetadata($id);

        return $this->groupService->getGroupById($id);
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        // No 'access denied' needed, the service only returns groups to which the authenticated user has access to
        if (!$this->authorizationService->getCanUse()) {
            return [];
        }

        return $this->groupService->getGroups($currentPageNumber, $maxNumItemsPerPage, $options);
    }
}
