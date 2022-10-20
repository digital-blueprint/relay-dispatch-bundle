<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\CampusonlineApi\LegacyWebService\Api;
use Dbp\CampusonlineApi\LegacyWebService\ApiException;
use Dbp\CampusonlineApi\LegacyWebService\Organization\OrganizationUnitApi;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\Group;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;

class GroupService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $config;
    private $api;
    private $cachePool;
    private $cacheTTL;
    private $auth;

    public function __construct(AuthorizationService $auth)
    {
        $this->logger = new NullLogger();
        $this->cacheTTL = 60;
        $this->auth = $auth;
    }

    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    public function setCache(?CacheItemPoolInterface $cachePool, int $ttl)
    {
        $this->cachePool = $cachePool;
        $this->cacheTTL = $ttl;
    }

    private function getApi(): OrganizationUnitApi
    {
        if ($this->api === null) {
            $accessToken = $this->config['api_token'] ?? '';
            $baseUrl = $this->config['api_url'] ?? '';
            $rootOrgUnitId = $this->config['org_root_id'] ?? '';

            $api = new Api($baseUrl, $accessToken, $rootOrgUnitId, $this->logger, $this->cachePool, $this->cacheTTL);
            $this->api = $api->OrganizationUnit();
        }

        return $this->api;
    }

    /**
     * @throws ApiException
     */
    public function getGroupById(string $identifier, array $options = []): Group
    {
        $api = $this->getApi();
        $data = $api->getOrganizationUnitById($identifier, $options);
        $group = new Group();
        $group->setIdentifier($data->getIdentifier());
        $group->setName($data->getName());

        return $group;
    }

    /**
     * @throws ApiException
     */
    public function getGroups(array $options = []): array
    {
        $api = $this->getApi();
        $userGroupIds = $this->auth->getGroups();
        $groups = [];
        foreach ($userGroupIds as $identifier) {
            $data = $api->getOrganizationUnitById($identifier, $options);
            $group = new Group();
            $group->setIdentifier($data->getIdentifier());
            $group->setName($data->getName());
            $groups[] = $group;
        }

        return $groups;
    }
}
