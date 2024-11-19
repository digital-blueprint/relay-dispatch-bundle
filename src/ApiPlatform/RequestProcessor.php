<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\State\ProcessorInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Rest\CustomControllerTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @psalm-suppress MissingTemplateParam
 */
class RequestProcessor extends AbstractController implements ProcessorInterface
{
    use CustomControllerTrait;

    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    /**
     * @return Request|void
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $this->requireAuthentication();
        $this->authorizationService->checkCanUse();

        // We need to make sure the user has write access to the old group in case the user changes it
        if (isset($context['previous_data'])) {
            $previousData = $context['previous_data'];
            assert($previousData instanceof Request);
            $this->authorizationService->checkCanWrite($previousData->getGroupId());
        }

        $request = $data;
        assert($request instanceof Request);
        $this->authorizationService->checkCanWrite($request->getGroupId());

        if ($operation instanceof DeleteOperationInterface) {
            if ($request->isSubmitted()) {
                throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
            }

            $this->dispatchService->removeRequestById($request->getIdentifier());

            return;
        } elseif ($operation instanceof Patch) {
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
