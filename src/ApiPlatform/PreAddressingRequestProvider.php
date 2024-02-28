<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\PreAddressingRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

/**
 * @implements ProviderInterface<PreAddressingRequest>
 */
final class PreAddressingRequestProvider extends AbstractController implements ProviderInterface
{
    /**
     * @var AuthorizationService
     */
    private $auth;

    public function __construct(AuthorizationService $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @return null
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        throw new MethodNotAllowedHttpException(['POST']);
    }
}
