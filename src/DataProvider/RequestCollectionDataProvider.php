<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Helpers\ArrayFullPaginator;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class RequestCollectionDataProvider extends AbstractController implements CollectionDataProviderInterface, RestrictedDataProviderInterface
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

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Request::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): ArrayFullPaginator
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        $filters = $context['filters'] ?? [];

        if (!isset($filters['groupId'])) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'groupId query parameter missing');
        }
        $groupId = $filters['groupId'];
        $this->auth->checkCanReadMetadata($groupId);

        $perPage = 30;
        $page = 1;

        if (isset($filters['page'])) {
            $page = (int) $filters['page'];
        }
        if (isset($filters['perPage'])) {
            $perPage = (int) $filters['perPage'];
        }

        $requests = $this->dispatchService->getRequestsForGroupId($groupId);

        // If the user can't read the content, hide the files and the name
        if (!$this->auth->getCanReadContent($groupId)) {
            foreach ($requests as $request) {
                $request->setRequestFiles(new ArrayCollection());
                $request->setName('');
            }
        }

        return new ArrayFullPaginator(
            $requests,
            $page,
            $perPage);
    }
}
