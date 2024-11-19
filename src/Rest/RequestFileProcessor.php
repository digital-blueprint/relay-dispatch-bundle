<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Rest;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Rest\AbstractDataProcessor;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\HttpFoundation\Response;

class RequestFileProcessor extends AbstractDataProcessor
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

    protected function removeItem(mixed $identifier, mixed $data, array $filters): void
    {
        $requestFile = $data;
        assert($requestFile instanceof RequestFile);

        $request = $this->dispatchService->getRequestById($requestFile->getDispatchRequestIdentifier());
        $this->authorizationService->checkCanWrite($request->getGroupId());

        if ($request->isSubmitted()) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
        }

        $this->dispatchService->removeRequestFileById($requestFile->getIdentifier());
    }
}
