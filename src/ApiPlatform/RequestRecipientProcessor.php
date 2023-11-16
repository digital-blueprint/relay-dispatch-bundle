<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Post;
use ApiPlatform\State\ProcessorInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RequestRecipientProcessor extends AbstractController implements ProcessorInterface
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
     * @return void|RequestRecipient
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($operation instanceof DeleteOperationInterface) {
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
        } elseif ($operation instanceof Post) {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $this->auth->checkCanUse();

            $requestRecipient = $data;
            assert($requestRecipient instanceof RequestRecipient);

            // Check if current person owns the request
            $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());

            $this->auth->checkCanWrite($request->getGroupId());

            // Check if the recipient is valid
            $requestRecipient->postValidityCheck();

            $this->dispatchService->handleRequestRecipientStorage($requestRecipient);

            return $requestRecipient;
        } else {
            throw new \RuntimeException('not implemented');
        }
    }
}
