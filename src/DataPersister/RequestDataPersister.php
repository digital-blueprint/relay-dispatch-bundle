<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class RequestDataPersister extends AbstractController implements ContextAwareDataPersisterInterface
{
    /**
     * @var DispatchService
     */
    private $dispatchService;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var AuthorizationService
     */
    private $auth;

    public function __construct(DispatchService $dispatchService, RequestStack $requestStack, AuthorizationService $auth)
    {
        $this->dispatchService = $dispatchService;
        $this->requestStack = $requestStack;
        $this->auth = $auth;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Request;
    }

    /**
     * @param mixed $data
     *
     * @return Request
     */
    public function persist($data, array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        // We need to make sure the user has write access to the old group in case the user changes it
        if (isset($context['previous_data'])) {
            $previousData = $context['previous_data'];
            assert($previousData instanceof Request);
            $this->auth->checkCanWrite($previousData->getGroupId());
        }

        $request = $data;
        assert($request instanceof Request);

        // Only allow if we can write within the given group
        $this->auth->checkCanWrite($request->getGroupId());

        if ($request->getIdentifier() === '') {
            return $this->dispatchService->createRequest($request);
        } else {
            if ($request->isSubmitted()) {
                throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
            }

            return $this->dispatchService->updateRequest($request);
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

        $request = $data;
        assert($request instanceof Request);

        $this->auth->checkCanWrite($request->getGroupId());

        if ($request->isSubmitted()) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
        }

        $this->dispatchService->removeRequestById($request->getIdentifier());
    }
}
