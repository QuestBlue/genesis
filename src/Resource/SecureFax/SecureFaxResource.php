<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Resource\SecureFax;

use QuestBlue\Genesis\Resource\Resource;

/**
 * SecureFax Resource Handler
 *
 * This class serves as the main entry point for accessing SecureFax-related resources
 * and provides access to various sub-resources like company management.
 */
class SecureFaxResource extends Resource
{
    /**
     * Get the company resource handler
     *
     * Provides access to company-related operations within the SecureFax system,
     * such as creating, deleting, locking, and unlocking companies.
     *
     * @return SecureFaxCompanyResource A new instance of the company resource handler
     */
    public function company(): SecureFaxCompanyResource
    {
        return new SecureFaxCompanyResource($this->connector);
    }

    /**
     * Access the users resource of the SecureFax API.
     *
     * @return SecureFaxUsersResource The resource for managing user-related operations.
     */
    public function users(): SecureFaxUsersResource
    {
        return new SecureFaxUsersResource($this->connector);
    }

    public function did(): SecureFaxDidResource
    {
        return new SecureFaxDidResource($this->connector);
    }

}