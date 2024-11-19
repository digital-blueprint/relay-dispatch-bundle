<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Rest;

use Dbp\Relay\CoreBundle\Rest\AbstractDataProcessor;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\PreAddressingRequest;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\Uid\Uuid;

class PreAddressingRequestProcessor extends AbstractDataProcessor
{
    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    protected function isCurrentUserGrantedOperationAccess(int $operation): bool
    {
        return $this->authorizationService->getCanWriteSomething();
    }

    protected function addItem(mixed $data, array $filters): PreAddressingRequest
    {
        // Users only need pre-addressing if they can create new delivery requests, so only if
        // they have the right to write something in at elast one group.
        $preAddressingRequest = $data;
        assert($preAddressingRequest instanceof PreAddressingRequest);
        $preAddressingRequest->setIdentifier((string) Uuid::v4());

        $this->dispatchService->doPreAddressingSoapRequestForPreAddressingRequest($preAddressingRequest);

        return $preAddressingRequest;
    }
}
