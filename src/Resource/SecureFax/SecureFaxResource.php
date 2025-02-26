<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Resource\SecureFax;

use QuestBlue\Genesis\Resource\Resource;

/**
 * Class SecureFaxResource
 *
 * The main resource handler for SecureFax API interactions.
 * This class provides access to various sub-resources such as company, user, and DID management.
 */
class SecureFaxResource extends Resource
{
    /**
     * Access the company resource handler.
     *
     * Provides access to company-related operations within the SecureFax system,
     * including creating, deleting, locking, and unlocking companies.
     *
     * @return SecureFaxCompanyResource A new instance of the company resource handler.
     */
    public function company(): SecureFaxCompanyResource
    {
        return new SecureFaxCompanyResource($this->connector);
    }

    /**
     * Access the users resource of the SecureFax API.
     *
     * This resource handles user-related operations, such as retrieving, managing, and modifying users.
     *
     * @return SecureFaxUsersResource The resource for managing user-related operations.
     */
    public function users(): SecureFaxUsersResource
    {
        return new SecureFaxUsersResource($this->connector);
    }

    /**
     * Access the DID (Direct Inward Dialing) resource of the SecureFax API.
     *
     * This resource allows management of DID numbers, including listing, creating, and deleting them.
     *
     * @return SecureFaxDidResource The resource for managing DID-related operations.
     */
    public function did(): SecureFaxDidResource
    {
        return new SecureFaxDidResource($this->connector);
    }
}
