<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Dbp\Relay\CoreBundle\Rest\CustomControllerTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\PreAddressingRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

/**
 * @implements ProviderInterface<PreAddressingRequest>
 */
final class PreAddressingRequestProvider extends AbstractController implements ProviderInterface
{
    use CustomControllerTrait;

    public function __construct(
        private readonly AuthorizationService $authorizationService)
    {
    }

    /**
     * @return null
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $this->requireAuthentication();
        $this->authorizationService->checkCanUse();

        throw new MethodNotAllowedHttpException(['POST']);
    }
}
