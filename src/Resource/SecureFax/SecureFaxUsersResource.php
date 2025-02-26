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
     * Retrieve a list of users
     *
     * Fetches a list of users with optional pagination parameters to control
     * the subset of results returned.
     *
     * @param  array|null  $pagination  Optional associative array for pagination parameters (e.g., page number, limit).
     *
     * @return Response The response object containing the list of users and metadata.
     */
    public function list(?array $pagination = null): Response
    {
        return $this->connector->send(new ListUsersRequest($pagination));
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