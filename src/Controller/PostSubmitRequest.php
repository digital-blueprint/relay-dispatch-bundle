<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Controller;

use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;

class PostSubmitRequest extends BaseDispatchController
{
    /**
     * @var DispatchService
     */
    private $dispatchService;

    public function __construct(DispatchService $dispatchService)
    {
        $this->dispatchService = $dispatchService;
    }

    public function __invoke(string $identifier): Request
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_SCOPE_DISPATCH');

        $request = $this->dispatchService->getRequestByIdForCurrentPerson($identifier);

        $this->dispatchService->submitRequest($request);

        return $request;
    }
}
