<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use Dbp\Relay\CoreBundle\Rest\CustomControllerTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostSubmitRequest extends AbstractController
{
    use CustomControllerTrait;

    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    public function __invoke(string $identifier): Request
    {
        $this->requireAuthentication();
        $this->authorizationService->checkCanUse();

        $request = $this->dispatchService->getRequestById($identifier);

        $this->authorizationService->checkCanWrite($request->getGroupId());

        $this->dispatchService->checkRequestReadyForSubmit($request);
        $this->dispatchService->submitRequest($request);

        return $request;
    }
}
