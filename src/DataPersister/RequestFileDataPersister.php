<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RequestFileDataPersister extends AbstractController implements ContextAwareDataPersisterInterface
{
    /**
     * @var DispatchService
     */
    private $dispatchService;

    public function __construct(DispatchService $dispatchService)
    {
        $this->dispatchService = $dispatchService;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof RequestFile;
    }

    /**
     * @param mixed $data
     *
     * @return RequestFile
     */
    public function persist($data, array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_SCOPE_DISPATCH');

        $requestFile = $data;
        assert($requestFile instanceof RequestFile);

        // Check if current person owns the request
        $this->dispatchService->getRequestByIdForCurrentPerson($requestFile->getDispatchRequestIdentifier());

        return $this->dispatchService->createRequestFile($requestFile);
    }

    /**
     * @param mixed $data
     *
     * @return void
     */
    public function remove($data, array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_SCOPE_DISPATCH');

        $requestFile = $data;
        assert($requestFile instanceof RequestFile);

        // Check if current person owns the request
        $this->dispatchService->getRequestByIdForCurrentPerson($requestFile->getDispatchRequestIdentifier());

        $this->dispatchService->removeRequestFileById($requestFile->getIdentifier());
    }
}
