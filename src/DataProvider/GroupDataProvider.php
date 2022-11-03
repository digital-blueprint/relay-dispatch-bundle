<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataProvider;

use Dbp\Relay\CoreBundle\DataProvider\AbstractDataProvider;
use Dbp\Relay\DispatchBundle\Entity\Group;
use Dbp\Relay\DispatchBundle\Service\GroupService;
use Symfony\Component\HttpFoundation\RequestStack;

class GroupDataProvider extends AbstractDataProvider
{
    /** @var GroupService */
    private $groupService;

    public function __construct(GroupService $groupService, RequestStack $requestStack)
    {
        parent::__construct($requestStack);

        $this->groupService = $groupService;
    }

    protected function getResourceClass(): string
    {
        return Group::class;
    }

    protected function getItemById($id, array $options = []): object
    {
        return $this->groupService->getGroupById($id);
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        return $this->groupService->getGroups($currentPageNumber, $maxNumItemsPerPage, $options);
    }

    protected function onOperationStart(int $operation)
    {
        parent::onOperationStart($operation);

        $this->denyAccessUnlessGranted('ROLE_SCOPE_DISPATCH');
    }
}
