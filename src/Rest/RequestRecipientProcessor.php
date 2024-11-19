<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Rest;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Rest\AbstractDataProcessor;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\HttpFoundation\Response;

class RequestRecipientProcessor extends AbstractDataProcessor
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

    protected function addItem(mixed $data, array $filters): mixed
    {
        assert($data instanceof RequestRecipient);
        $requestRecipient = $data;

        if ($requestRecipient->getDispatchRequestIdentifier() === null) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, '\'dispatchRequestIdentifier\' is required',
                'dispatch:request-recipient-missing-request-identifier');
        }

        $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());
        $this->authorizationService->checkCanWrite($request->getGroupId());

        $requestRecipient->postValidityCheck();
        $this->dispatchService->handleRequestRecipientStorage($requestRecipient);

        return $requestRecipient;
    }

    protected function removeItem(mixed $identifier, mixed $data, array $filters): void
    {
        assert($data instanceof RequestRecipient);
        $requestRecipient = $data;

        $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());
        $this->authorizationService->checkCanWrite($request->getGroupId());

        if ($request->isSubmitted()) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
        }

        $this->dispatchService->removeRequestRecipientById($requestRecipient->getIdentifier());
    }
}
