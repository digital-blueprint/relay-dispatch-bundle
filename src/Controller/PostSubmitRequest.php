<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Controller;

use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;

class PostSubmitRequest extends BaseDispatchController
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

    public function __invoke(string $identifier): Request
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $request = $this->dispatchService->getRequestByIdForCurrentPerson($identifier);

        $this->auth->checkCanWrite($request->getGroupId());

        $this->dispatchService->checkRequestReadyForSubmit($request);
        $this->dispatchService->submitRequest($request);

        return $request;
    }
}
