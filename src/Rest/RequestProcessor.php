<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Rest;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Rest\AbstractDataProcessor;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\HttpFoundation\Response;

class RequestProcessor extends AbstractDataProcessor
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

    protected function addItem(mixed $data, array $filters): Request
    {
        $request = $data;
        assert($request instanceof Request);
        $this->authorizationService->checkCanWrite($request->getGroupId());

        return $this->dispatchService->createRequest($request);
    }

    protected function updateItem(mixed $identifier, mixed $data, mixed $previousData, array $filters): Request
    {
        $request = $data;
        assert($request instanceof Request);
        $this->authorizationService->checkCanWrite($request->getGroupId());

        // We need to make sure the user has write access to the old group in case the user changes it
        $previousRequest = $previousData;
        assert($previousRequest instanceof Request);
        $this->authorizationService->checkCanWrite($previousRequest->getGroupId());

        if ($request->isSubmitted()) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
        }

        return $this->dispatchService->updateRequest($request);
    }

    protected function removeItem(mixed $identifier, mixed $data, array $filters): void
    {
        $request = $data;
        assert($request instanceof Request);
        $this->authorizationService->checkCanWrite($request->getGroupId());

        if ($request->isSubmitted()) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
        }

        $this->dispatchService->removeRequestById($request->getIdentifier());
    }
}
