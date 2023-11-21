<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\State\ProcessorInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RequestProcessor extends AbstractController implements ProcessorInterface
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

    /**
     * @param mixed $data
     *
     * @return Request|void
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
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
        $this->auth->checkCanWrite($request->getGroupId());

        if ($operation instanceof DeleteOperationInterface) {
            if ($request->isSubmitted()) {
                throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
            }

            $this->dispatchService->removeRequestById($request->getIdentifier());

            return;
        } elseif ($operation instanceof Put) {
            if ($request->isSubmitted()) {
                throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
            }

            return $this->dispatchService->updateRequest($request);
        } elseif ($operation instanceof Post) {
            return $this->dispatchService->createRequest($request);
        }

        throw new \RuntimeException('not implemented');
    }
}
