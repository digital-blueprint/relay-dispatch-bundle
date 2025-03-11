<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Rest;

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
        parent::__construct();
    }

    protected function isCurrentUserGrantedOperationAccess(int $operation): bool
    {
        return $operation === self::GET_COLLECTION_OPERATION
            || $this->authorizationService->getCanUse();
    }

    protected function getItemById($id, array $filters = [], array $options = []): object
    {
        $this->authorizationService->checkCanReadMetadata($id);

        return $this->groupService->getGroupById($id);
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        // No 'forbidden' error needed, the service only returns groups to which the authenticated user has access to
        return $this->authorizationService->getCanUse() ?
            $this->groupService->getGroups($currentPageNumber, $maxNumItemsPerPage, $options) :
            [];
    }
}
