<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Resource\SecureFax;

use QuestBlue\Genesis\Requests\SecureFax\User\ListUsersRequest;
use QuestBlue\Genesis\Resource\Resource;
use Saloon\Http\Response;

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
     * Retrieve a list of users in the SecureFax Api
     * @return Response The response object containing the list of users and metadata.
     */
    public function list(): Response
    {
        return $this->connector->send(new ListUsersRequest());
    }

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
