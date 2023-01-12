<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RequestRecipientDataPersister extends AbstractController implements ContextAwareDataPersisterInterface
{
    /**
     * @var DispatchService
     */
    private $dispatchService;
    /**
     * @var AuthorizationService
     */
    private $auth;

    public function __construct(DispatchService $dispatchService, AuthorizationService $auth)
    {
        $this->dispatchService = $dispatchService;
        $this->auth = $auth;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof RequestRecipient;
    }

    /**
     * @param mixed $data
     *
     * @return RequestRecipient
     */
    public function persist($data, array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        $requestRecipient = $data;
        assert($requestRecipient instanceof RequestRecipient);

        // Check if current person owns the request
        $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());

        $this->auth->checkCanWrite($request->getGroupId());

        if ($requestRecipient->getIdentifier() === '') {
            return $this->dispatchService->createRequestRecipient($requestRecipient);
        } else {
            if ($request->isSubmitted()) {
                throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
            }

            return $this->dispatchService->updateRequestRecipient($requestRecipient);
        }
    }

    /**
     * @param mixed $data
     *
     * @return void
     */
    public function remove($data, array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        $requestRecipient = $data;
        assert($requestRecipient instanceof RequestRecipient);

        // Check if current person owns the request
        $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());

        $this->auth->checkCanWrite($request->getGroupId());

        if ($request->isSubmitted()) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
        }

        $this->dispatchService->removeRequestRecipientById($requestRecipient->getIdentifier());
    }
}
