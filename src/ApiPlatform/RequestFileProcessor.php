<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Rest\CustomControllerTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @psalm-suppress MissingTemplateParam
 */
class RequestFileProcessor extends AbstractController implements ProcessorInterface
{
    use CustomControllerTrait;

    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    /**
     * @return void
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $this->requireAuthentication();
        $this->authorizationService->checkCanUse();

        if ($operation instanceof DeleteOperationInterface) {
            $requestFile = $data;
            assert($requestFile instanceof RequestFile);

            $request = $this->dispatchService->getRequestById($requestFile->getDispatchRequestIdentifier());

            $this->authorizationService->checkCanWrite($request->getGroupId());

            if ($request->isSubmitted()) {
                throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
            }

            $this->dispatchService->removeRequestFileById($requestFile->getIdentifier());
        } else {
            throw new \RuntimeException('not implemented');
        }
    }
}
