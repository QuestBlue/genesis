<?php

namespace QuestBlue\Genesis\Data\SecureFax;

/**
 * Class UserData
 *
 * Represents a user within the SecureFax system.
 * This class stores user-related information, including permissions, roles, and status flags.
 *
 * @package QuestBlue\Genesis\Data\SecureFax
 */
readonly class UserData
{
    /**
     * UserData Constructor.
     *
     * @param array|null  $aclPermissionsArray Array of access control list (ACL) permissions assigned to the user.
     * @param string|null $roleId              The role identifier associated with the user.
     * @param string      $id                  The unique identifier of the user.
     * @param string      $fullName            The full name of the user.
     * @param string      $email               The email address of the user.
     * @param bool        $admin               Indicates if the user has administrative privileges.
     * @param bool        $locked              Indicates if the user account is locked.
     */
    public function __construct(
        public ?array $aclPermissionsArray,
        public ?string $roleId,
        public string $id,
        public string $fullName,
        public string $email,
        public bool $admin,
        public bool $locked,
    ) {}

    /**
     * Create a UserData instance from an associative array.
     *
     * Converts an array of user data into a UserData object.
     *
     * @param array $data The input array containing user details.
     *
     * @return self Returns an instance of UserData.
     */
    public static function fromArray(array $data): self
    {
        return new static(
            aclPermissionsArray: $data['aclPermissionsArray'] ?? null,
            roleId: $data['roleId'] ?? null,
            id: $data['id'],
            fullName: $data['fullName'],
            email: $data['email'],
            admin: (bool) $data['admin'],
            locked: (bool) $data['locked'],
        );
    }
}
