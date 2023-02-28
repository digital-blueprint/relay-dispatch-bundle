<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Authorization;

use Dbp\Relay\CoreBundle\Authorization\AbstractAuthorizationService;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\DependencyInjection\Configuration;
use Symfony\Component\HttpFoundation\Response;

class AuthorizationService extends AbstractAuthorizationService
{
    /** @var string An alias variable name for the group data variable that can be used in group role expressions */
    private const GROUP_DATA_ALIAS = 'currentGroup';

    /**
     * Check if the user can access the application at all.
     */
    public function checkCanUse(): void
    {
        $this->denyAccessUnlessIsGranted(Configuration::ROLE_USER);
    }

    /**
     * Returns if the user can use the application at all.
     */
    public function getCanUse(): bool
    {
        return $this->isGranted(Configuration::ROLE_USER);
    }

    /**
     * Check if the user can read the group metadata, throws if not.
     */
    public function checkCanReadMetadata(string $groupId): void
    {
        if ($this->getCanReadMetadata($groupId)) {
            return;
        }
        throw new ApiError(Response::HTTP_FORBIDDEN, 'access denied');
    }

    /**
     * Check if the user can read the group content, throws if not.
     */
    public function checkCanReadContent(string $groupId): void
    {
        if ($this->getCanReadContent($groupId)) {
            return;
        }
        throw new ApiError(Response::HTTP_FORBIDDEN, 'access denied');
    }

    /**
     * Check if the user can write in the group, throws if not.
     */
    public function checkCanWrite(string $groupId): void
    {
        if ($this->getCanWrite($groupId)) {
            return;
        }
        throw new ApiError(Response::HTTP_FORBIDDEN, 'access denied');
    }

    /**
     * Returns if the user can write in the group.
     */
    public function getCanWrite(string $groupId): bool
    {
        // XXX: should we check isValidGroup() in all cases?
        // At least check it here where we input data into the system
        if (!$this->isValidGroup($groupId)) {
            return false;
        }

        return $this->isGrantedGroupRole(Configuration::ROLE_GROUP_WRITER, new GroupData($groupId));
    }

    /**
     * Returns if the user can read something in a group.
     */
    public function getCanReadMetadata(string $groupId): bool
    {
        $groupData = new GroupData($groupId);
        if ($this->isGrantedGroupRole(Configuration::ROLE_GROUP_WRITER, $groupData) ||
            $this->isGrantedGroupRole(Configuration::ROLE_GROUP_READER_CONTENT, $groupData) ||
            $this->isGrantedGroupRole(Configuration::ROLE_GROUP_READER_METADATA, $groupData)) {
            return true;
        }

        return false;
    }

    /**
     * Returns if the user can read something in a group.
     */
    public function getCanReadContent(string $groupId): bool
    {
        $groupData = new GroupData($groupId);
        if ($this->isGrantedGroupRole(Configuration::ROLE_GROUP_WRITER, $groupData) ||
            $this->isGrantedGroupRole(Configuration::ROLE_GROUP_READER_CONTENT, $groupData)) {
            return true;
        }

        return false;
    }

    /**
     * Check if the user has write access in at least one group.
     */
    public function checkCanWriteSomething(): void
    {
        $groups = $this->getGroups();
        foreach ($groups as $id) {
            if ($this->getCanWrite($id)) {
                return;
            }
        }
        throw new ApiError(Response::HTTP_FORBIDDEN, 'access denied');
    }

    /**
     * Returns if the group ID is valid.
     */
    private function isValidGroup(string $groupId): bool
    {
        return in_array($groupId, $this->getGroups(), true);
    }

    /**
     * Returns all groups the user has some kind of access to.
     *
     * @return string[]
     */
    public function getGroups(): array
    {
        $allGroups = $this->getAttribute(Configuration::ATTRIBUTE_GROUPS);
        $groups = [];
        foreach ($allGroups as $id) {
            if ($this->getCanReadMetadata($id)) {
                $groups[] = $id;
            }
        }

        return $groups;
    }

    private function isGrantedGroupRole(string $roleName, GroupData $groupData): bool
    {
        return $this->isGranted($roleName, $groupData, self::GROUP_DATA_ALIAS);
    }
}
