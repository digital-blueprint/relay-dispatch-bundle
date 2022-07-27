<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestRecipientDataPersister extends AbstractController implements ContextAwareDataPersisterInterface
{
    /**
     * @var DispatchService
     */
    private $dispatchService;

    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(DispatchService $dispatchService, RequestStack $requestStack)
    {
        $this->dispatchService = $dispatchService;
        $this->requestStack = $requestStack;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof RequestRecipient;
    }

    /**
     * @param mixed $data
     *
     * @return RequestRecipient
     */
    public function persist($data, array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_SCOPE_DISPATCH');

        $requestRecipient = $data;
        assert($requestRecipient instanceof RequestRecipient);

        dump($data);

        // Check if current person owns request
        $this->dispatchService->getRequestByIdForCurrentPerson($requestRecipient->getDispatchRequestIdentifier());

        return $this->dispatchService->createRequestRecipient($requestRecipient);
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

        $requestRecipient = $data;
        assert($requestRecipient instanceof RequestRecipient);
        // TODO: Implement
//        $this->dispatchService->removeRequestRecipientByIdForCurrentPerson($requestRecipient->getIdentifier());
    }
}
