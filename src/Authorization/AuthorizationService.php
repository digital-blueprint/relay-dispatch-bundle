<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Authorization;

use Dbp\Relay\CoreBundle\Authorization\AbstractAuthorizationService;

class AuthorizationService extends AbstractAuthorizationService
{
    public function checkCanRead(string $groupId)
    {
        $this->denyAccessUnlessIsGranted('GROUP_READER', new GroupData($groupId));
    }

    public function checkCanWrite(string $groupId)
    {
        $this->denyAccessUnlessIsGranted('GROUP_WRITER', new GroupData($groupId));
    }

    public function checkIsAdmin()
    {
        $this->denyAccessUnlessIsGranted('ADMIN');
    }

    public function checkIsManager()
    {
        $this->denyAccessUnlessIsGranted('MANAGER');
    }

    /**
     * @return string[]
     */
    public function getGroups(): array
    {
        $groups = $this->getAttribute('GROUPS', []);
        assert(is_array($groups));

        // XXX: for testing
        $groups = ['1263', '1190', '681', '1231', '2322', '2374', '11072'];

        return $groups;
    }
}
