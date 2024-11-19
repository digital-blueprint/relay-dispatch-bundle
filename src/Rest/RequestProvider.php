<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Rest;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Rest\AbstractDataProvider;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\HttpFoundation\Response;

/**
 * @extends  AbstractDataProvider<Request>
 */
final class RequestProvider extends AbstractDataProvider
{
    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    protected function isCurrentUserGrantedOperationAccess(int $operation): bool
    {
        return $this->authorizationService->getCanUse();
    }

    protected function getItemById(string $id, array $filters = [], array $options = []): ?Request
    {
        $request = $this->dispatchService->getRequestById($id);
        $groupId = $request->getGroupId();
        $this->authorizationService->checkCanReadMetadata($groupId);

        return $request;
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        $groupId = $filters['groupId'] ?? null;
        if ($groupId === null) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'groupId query parameter missing');
        }
        $this->authorizationService->checkCanReadMetadata($groupId);

        return $this->dispatchService->getRequestsForGroupId($groupId, $currentPageNumber, $maxNumItemsPerPage);
    }
}
