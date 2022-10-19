<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\CampusonlineApi\LegacyWebService\Api;
use Dbp\CampusonlineApi\LegacyWebService\ApiException;
use Dbp\CampusonlineApi\LegacyWebService\Organization\OrganizationUnitApi;
use Dbp\Relay\DispatchBundle\Entity\Group;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;

class GroupService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $config;
    private $api;

    public function __construct()
    {
        $this->logger = new NullLogger();
    }

    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    private function getApi(): OrganizationUnitApi
    {
        if ($this->api === null) {
            $accessToken = $this->config['api_token'] ?? '';
            $baseUrl = $this->config['api_url'] ?? '';
            $rootOrgUnitId = $this->config['org_root_id'] ?? '';

            $api = new Api($baseUrl, $accessToken, $rootOrgUnitId, $this->logger);
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
        $paginator = $api->getOrganizationUnits($options);
        $groups = [];
        foreach ($paginator->getItems() as $data) {
            $group = new Group();
            $group->setIdentifier($data->getIdentifier());
            $group->setName($data->getName());
            $groups[] = $group;
        }

        return $groups;
    }
}
