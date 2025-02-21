<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Resource\SecureFax;

use QuestBlue\Genesis\Resource\Resource;

/**
 * SecureFax Administrator Resource Handler
 *
 * This class manages admin-user-related operations within the SecureFax system,
 * providing methods to create, and delete Administrators.
 * It handles all administrator-specific API endpoints and their corresponding requests.
 */
class SecureFaxUsersResource extends Resource
{

    /**
     * Get the administrator resource handler
     *
     * Provides access to administrator-related operations within the SecureFax system,
     * including tasks such as creating, managing, or modifying administrators.
     *
     * @return SecureFaxManagerResource A new instance of the administrator resource handler
     */
    public function manager(): SecureFaxManagerResource
    {
        return new SecureFaxManagerResource($this->connector);
    }

}