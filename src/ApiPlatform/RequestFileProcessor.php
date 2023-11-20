<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RequestFileProcessor extends AbstractController implements ProcessorInterface
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
     * @return void
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        if ($operation instanceof DeleteOperationInterface) {
            $requestFile = $data;
            assert($requestFile instanceof RequestFile);

            $request = $this->dispatchService->getRequestById($requestFile->getDispatchRequestIdentifier());

            $this->auth->checkCanWrite($request->getGroupId());

            if ($request->isSubmitted()) {
                throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
            }

            $this->dispatchService->removeRequestFileById($requestFile->getIdentifier());
        } else {
            throw new \RuntimeException('not implemented');
        }
    }
}
