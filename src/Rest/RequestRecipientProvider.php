<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Rest;

use Dbp\Relay\CoreBundle\Rest\AbstractDataProvider;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Service\DispatchService;

/**
 * @extends AbstractDataProvider<RequestRecipient>
 */
final class RequestRecipientProvider extends AbstractDataProvider
{
    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
        parent::__construct();
    }

    protected function getItemById(string $id, array $filters = [], array $options = []): ?object
    {
        $requestRecipient = $this->dispatchService->getRequestRecipientById($id);
        $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());
        $this->authorizationService->checkCanReadMetadata($request->getGroupId());

        return $requestRecipient;
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        return [];
    }
}
