<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Post;
use ApiPlatform\State\ProcessorInterface;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\PreAddressingRequest;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Uid\Uuid;

class PreAddressingRequestProcessor extends AbstractController implements ProcessorInterface
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

    public function process($data, Operation $operation, array $uriVariables = [], array $context = []): PreAddressingRequest
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        if (!$operation instanceof Post) {
            throw new \RuntimeException('not implemented');
        }

        // Users only need pre-addressing if they can create new delivery requests, so only if
        // they have the right to write something in at elast one group.
        $this->auth->checkCanWriteSomething();

        $preAddressingRequest = $data;
        assert($preAddressingRequest instanceof PreAddressingRequest);
        $preAddressingRequest->setIdentifier((string) Uuid::v4());

        $this->dispatchService->doPreAddressingSoapRequestForPreAddressingRequest($preAddressingRequest);

        return $preAddressingRequest;
    }
}
