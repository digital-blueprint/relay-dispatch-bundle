<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RequestFileDataPersister extends AbstractController implements ContextAwareDataPersisterInterface
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

    public function supports($data, array $context = []): bool
    {
        return $data instanceof RequestFile;
    }

    /**
     * @param mixed $data
     */
    public function persist($data, array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    }

    /**
     * @param mixed $data
     *
     * @return void
     */
    public function remove($data, array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $requestFile = $data;
        assert($requestFile instanceof RequestFile);

        $request = $this->dispatchService->getRequestById($requestFile->getDispatchRequestIdentifier());

        $this->auth->checkCanWrite($request->getGroupId());

        if ($request->isSubmitted()) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
        }

        $this->dispatchService->removeRequestFileById($requestFile->getIdentifier());
    }
}
