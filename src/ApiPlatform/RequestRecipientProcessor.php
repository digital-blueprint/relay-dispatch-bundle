<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Post;
use ApiPlatform\State\ProcessorInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Rest\CustomControllerTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @psalm-suppress MissingTemplateParam
 */
class RequestRecipientProcessor extends AbstractController implements ProcessorInterface
{
    use CustomControllerTrait;

    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    /**
     * @return void|RequestRecipient
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $this->requireAuthentication();
        $this->authorizationService->checkCanUse();

        assert($data instanceof RequestRecipient);
        $requestRecipient = $data;

        // Check if current person owns the request
        $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());
        $this->authorizationService->checkCanWrite($request->getGroupId());

        if ($operation instanceof DeleteOperationInterface) {
            if ($request->isSubmitted()) {
                throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
            }
            $this->dispatchService->removeRequestRecipientById($requestRecipient->getIdentifier());
        } elseif ($operation instanceof Post) {
            $requestRecipient->postValidityCheck();
            $this->dispatchService->handleRequestRecipientStorage($requestRecipient);

            return $requestRecipient;
        } else {
            throw new \RuntimeException('not implemented');
        }
    }
}
