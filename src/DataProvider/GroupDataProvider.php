<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataProvider;

use Dbp\Relay\CoreBundle\Rest\AbstractDataProvider;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Service\GroupService;

class GroupDataProvider extends AbstractDataProvider
{
    /** @var GroupService */
    private $groupService;

    /** @var AuthorizationService */
    private $auth;

    public function __construct(GroupService $groupService, AuthorizationService $auth)
    {
        parent::__construct();

        $this->groupService = $groupService;
        $this->auth = $auth;
    }

    protected function isUserGrantedOperationAccess(int $operation): bool
    {
        return $this->isAuthenticated();
    }

    protected function getItemById($id, array $filters = [], array $options = []): object
    {
        $this->auth->checkCanUse();
        $this->auth->checkCanReadMetadata($id);

        return $this->groupService->getGroupById($id);
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        // No 'access denied' needed, the service only returns groups to which the authenticated user has access to
        if (!$this->auth->getCanUse()) {
            return [];
        }

        return $this->groupService->getGroups($currentPageNumber, $maxNumItemsPerPage, $options);
    }
}
