<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
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

    public function __construct(DispatchService $dispatchService, RequestStack $requestStack)
    {
        $this->dispatchService = $dispatchService;
        $this->requestStack = $requestStack;
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
        $this->denyAccessUnlessGranted('ROLE_SCOPE_DISPATCH');

        $request = $data;
        assert($request instanceof Request);

        if ($request->getIdentifier() === '') {
            return $this->dispatchService->createRequestForCurrentPerson($request);
        } else {
            if ($request->isSubmitted()) {
                throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
            }

            return $this->dispatchService->updateRequestForCurrentPerson($request);
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
        $this->denyAccessUnlessGranted('ROLE_SCOPE_DISPATCH');

        $request = $data;
        assert($request instanceof Request);

        if ($request->isSubmitted()) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
        }

        $this->dispatchService->removeRequestByIdForCurrentPerson($request->getIdentifier());
    }
}
