<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\PreAddressingRequest;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Uid\Uuid;

class PreAddressingRequestDataPersister extends AbstractController implements ContextAwareDataPersisterInterface
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
        $this->auth->checkCanUse();
        // Users only need pre-addressing if they can create new delivery requests, so only if
        // they have the right to write something in at elast one group.
        $this->auth->checkCanWriteSomething();

        $preAddressingRequest = $data;
        assert($preAddressingRequest instanceof PreAddressingRequest);
        $preAddressingRequest->setIdentifier((string) Uuid::v4());

        $this->dispatchService->doPreAddressingSoapRequest($preAddressingRequest);
//        $requestRecipient = new RequestRecipient();
//        $requestRecipient->setGivenName($preAddressingRequest->getGivenName());
//        $requestRecipient->setFamilyName($preAddressingRequest->getFamilyName());
//        $requestRecipient->setBirthDate($preAddressingRequest->getBirthDate());
//
//        $xmlString = $this->dispatchService->generatePreAddressingAPIXML($requestRecipient);
//        $response = $this->dispatchService->doPreAddressingAPIRequest($xmlString);
//
        ////        dump($response);
//        if ($response) {
//            dump($response->getHeaders());
//            dump($response->getStatusCode());
//            dump($response->getBody()->getContents());
//        }

        return $preAddressingRequest;
    }

    /**
     * @param mixed $data
     *
     * @return void
     */
    public function remove($data, array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        throw new MethodNotAllowedHttpException([]);
    }
}
