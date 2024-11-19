<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Authorization;

use Dbp\Relay\CoreBundle\Authorization\AbstractAuthorizationService;
use Dbp\Relay\CoreBundle\Helpers\Tools;
use Dbp\Relay\DispatchBundle\DependencyInjection\Configuration;
use Dbp\Relay\DispatchBundle\Entity\Group;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AuthorizationService extends AbstractAuthorizationService
{
    /**
     * Check if the user can access the application at all.
     *
     * @throws AccessDeniedException
     */
    public function checkCanUse(): void
    {
        $this->denyAccessUnlessIsGrantedRole(Configuration::ROLE_USER);
    }

    /**
     * Returns if the user can use the application at all.
     */
    public function getCanUse(): bool
    {
        return $this->isGrantedRole(Configuration::ROLE_USER);
    }

    /**
     * Check if the user can read the group metadata, throws if not.
     *
     * @throws AccessDeniedException
     */
    public function checkCanReadMetadata(string $groupId): void
    {
        if (!$this->getCanReadMetadata($groupId)) {
            throw new AccessDeniedException();
        }
    }

    /**
     * Check if the user can read the group content, throws if not.
     *
     * @throws AccessDeniedException
     */
    public function checkCanReadContent(string $groupId): void
    {
        if (!$this->getCanReadContent($groupId)) {
            throw new AccessDeniedException();
        }
    }

    /**
     * Check if the user can write in the group, throws if not.
     *
     * @throws AccessDeniedException
     */
    public function checkCanWrite(string $groupId): void
    {
        if (!$this->getCanWrite($groupId)) {
            throw new AccessDeniedException();
        }
    }

    /**
     * Check if the user has write access in at least one group.
     *
     * @throws AccessDeniedException
     */
    public function checkCanWriteSomething(): void
    {
        foreach ($this->getAllGroupIds() as $groupId) {
            if ($this->getCanWrite($groupId)) {
                return;
            }
        }
        throw new AccessDeniedException();
    }

    /**
     * Returns if the user can write in the group.
     */
    public function getCanWrite(string $groupId, bool $validate = true): bool
    {
        // XXX: should we check isValidGroup() in all cases?
        // At least check it here where we input data into the system
        if ($validate && !$this->isValidGroup($groupId)) {
            return false;
        }

        return $this->isGrantedGroupRole(Configuration::ROLE_GROUP_WRITER, new GroupData($groupId))
                || $this->isGrantedGroupRole(Configuration::ROLE_GROUP_WRITER_READ_ADDRESS, new GroupData($groupId));
    }

    /**
     * Returns true if the user can read the internal addresses of recipients for the given group.
     * This means the addresses which the user hasn't entered themselves, but are provided by the backend.
     */
    public function canReadInternalAddresses(string $groupId): bool
    {
        return $this->isGrantedGroupRole(Configuration::ROLE_GROUP_WRITER_READ_ADDRESS, new GroupData($groupId));
    }

    /**
     * Returns if the user can read something in a group.
     */
    public function getCanReadMetadata(string $groupId): bool
    {
        $groupData = new GroupData($groupId);
        if ($this->isGrantedGroupRole(Configuration::ROLE_GROUP_WRITER_READ_ADDRESS, $groupData)
            || $this->isGrantedGroupRole(Configuration::ROLE_GROUP_WRITER, $groupData)
            || $this->isGrantedGroupRole(Configuration::ROLE_GROUP_READER_CONTENT, $groupData)
            || $this->isGrantedGroupRole(Configuration::ROLE_GROUP_READER_METADATA, $groupData)) {
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
        if ($this->isGrantedGroupRole(Configuration::ROLE_GROUP_WRITER_READ_ADDRESS, $groupData)
            || $this->isGrantedGroupRole(Configuration::ROLE_GROUP_WRITER, $groupData)
            || $this->isGrantedGroupRole(Configuration::ROLE_GROUP_READER_CONTENT, $groupData)) {
            return true;
        }

        return false;
    }

    /**
     * @return string[]
     */
    public function getGroupRolesForCurrentUser(string $groupId): array
    {
        $groupData = new GroupData($groupId);
        if ($this->isGrantedGroupRole(Configuration::ROLE_GROUP_WRITER_READ_ADDRESS, $groupData)) {
            return [
                Group::ROLE_WRITE_READ_ADDRESS,
                Group::ROLE_WRITE,
                Group::ROLE_READ_CONTENT,
                Group::ROLE_READ_METADATA,
            ];
        } elseif ($this->isGrantedGroupRole(Configuration::ROLE_GROUP_WRITER, $groupData)) {
            return [
                Group::ROLE_WRITE,
                Group::ROLE_READ_CONTENT,
                Group::ROLE_READ_METADATA,
            ];
        } elseif ($this->isGrantedGroupRole(Configuration::ROLE_GROUP_READER_CONTENT, $groupData)) {
            return [
                Group::ROLE_READ_CONTENT,
                Group::ROLE_READ_METADATA,
            ];
        } elseif ($this->isGrantedGroupRole(Configuration::ROLE_GROUP_READER_METADATA, $groupData)) {
            return [
                Group::ROLE_READ_METADATA,
            ];
        }

        return [];
    }

    /**
     * Returns all groups the user has some kind of access to.
     * WARNING: This function may cause performance issues! Try to avoid it.
     *
     * @return string[]
     */
    public function getGroupIdsForCurrentUser(): array
    {
        $groupIds = [];
        foreach ($this->getAllGroupIds() as $groupId) {
            if ($this->getCanReadMetadata($groupId)) {
                $groupIds[] = $groupId;
            }
        }

        return $groupIds;
    }

    public function validateConfiguration(): void
    {
        $testGroupId = '0';

        $this->getCanUse();
        $this->getCanReadMetadata($testGroupId);
        $this->getCanReadContent($testGroupId);
        $this->getCanWrite($testGroupId);
        $this->canReadInternalAddresses($testGroupId);
        $this->getAllGroupIds();
    }

    protected function setUpInputAndOutputGroups(): void
    {
        $this->showOutputGroupsForEntityInstanceIf(Request::class, ['DispatchRequest:read_content'],
            function (Request $request) {
                return $this->getCanReadContent($request->getGroupId());
            });
        // personal address of recipients is returned if
        // - it was entered manually by a user (i.e. person identifier is not set) OR
        // - the current user has write and read personal address permissions for the group
        $this->showOutputGroupsForEntityInstanceIf(RequestRecipient::class, ['DispatchRequestRecipient:read_address'],
            function (RequestRecipient $recipient) {
                return Tools::isNullOrEmpty($recipient->getPersonIdentifier())
                    || $this->canReadInternalAddresses(
                        $recipient->getDispatchRequest()->getGroupId());
            });
        // birthdate of recipients is returned if
        // - it was entered manually by a user (i.e. person identifier is not set)
        //   AND the current user at least has read content permissions for the group
        $this->showOutputGroupsForEntityInstanceIf(RequestRecipient::class, ['DispatchRequestRecipient:read_birth_date'],
            function (RequestRecipient $recipient) {
                return Tools::isNullOrEmpty($recipient->getPersonIdentifier())
                    && $this->getCanReadContent($recipient->getDispatchRequest()->getGroupId());
            });
    }

    /**
     * @return string[]
     */
    private function getAllGroupIds(): array
    {
        return (array) $this->getAttribute(Configuration::ATTRIBUTE_GROUPS, []);
    }

    /**
     * Returns if the group ID is in the list of groups.
     */
    private function isValidGroup(string $groupId): bool
    {
        return in_array($groupId, $this->getAllGroupIds(), true);
    }

    private function isGrantedGroupRole(string $roleName, GroupData $groupData): bool
    {
        return $this->isGrantedResourcePermission($roleName, $groupData);
    }
}
