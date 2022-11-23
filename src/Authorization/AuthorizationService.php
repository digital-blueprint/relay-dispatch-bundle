<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Authorization;

use Dbp\Relay\CoreBundle\Authorization\AbstractAuthorizationService;
use Dbp\Relay\DispatchBundle\DependencyInjection\Configuration;

class AuthorizationService extends AbstractAuthorizationService
{
    public function checkCanRead(string $groupId)
    {
        $this->denyAccessUnlessIsGranted(Configuration::GROUP_READER, new GroupData($groupId));
    }

    public function checkCanWrite(string $groupId)
    {
        $this->denyAccessUnlessIsGranted(Configuration::GROUP_WRITER, new GroupData($groupId));
    }

    public function checkIsAdmin()
    {
        $this->denyAccessUnlessIsGranted(Configuration::ADMIN);
    }

    public function checkIsManager()
    {
        $this->denyAccessUnlessIsGranted(Configuration::MANAGER);
    }

    /**
     * @return string[]
     */
    public function getGroupsMayRead(): array
    {
        return $this->getAttribute(Configuration::GROUPS_MAY_READ, []) ?? [];
    }

    /**
     * @return string[]
     */
    public function getGroupsMayWrite(): array
    {
        return $this->getAttribute(Configuration::GROUPS_MAY_WRITE, []) ?? [];
    }
}
