<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Rest;

use Dbp\Relay\CoreBundle\Rest\AbstractDataProvider;
use Dbp\Relay\CoreBundle\Rest\CustomControllerTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Service\DispatchService;

/**
 * @extends AbstractDataProvider<RequestFile>
 */
final class RequestFileProvider extends AbstractDataProvider
{
    use CustomControllerTrait;

    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
        parent::__construct();
    }

    protected function isCurrentUserGrantedOperationAccess(int $operation): bool
    {
        return $this->authorizationService->getCanUse();
    }

    protected function getItemById(string $id, array $filters = [], array $options = []): ?RequestFile
    {
        $requestFile = $this->dispatchService->getRequestFileById($id);
        $request = $this->dispatchService->getRequestById($requestFile->getDispatchRequestIdentifier());
        $this->authorizationService->checkCanReadContent($request->getGroupId());

        return $requestFile;
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        return [];
    }
}
