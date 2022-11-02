<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Entity\PreAddressingRequest;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

class PreAddressingRequestDataPersister extends AbstractController implements ContextAwareDataPersisterInterface
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
        return $data instanceof PreAddressingRequest;
    }

    /**
     * @param mixed $data
     *
     * @return PreAddressingRequest
     */
    public function persist($data, array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_SCOPE_DISPATCH');

        $preAddressingRequest = $data;
        assert($preAddressingRequest instanceof PreAddressingRequest);
        $preAddressingRequest->setIdentifier((string) Uuid::v4());

        return $preAddressingRequest;
    }

    /**
     * @param mixed $data
     *
     * @return void
     */
    public function remove($data, array $context = [])
    {
    }
}
