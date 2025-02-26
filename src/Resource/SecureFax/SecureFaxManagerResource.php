<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Resource\SecureFax;

use QuestBlue\Genesis\Requests\SecureFax\User\CreateAdministratorRequest;
use QuestBlue\Genesis\Resource\Resource;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

/**
 * SecureFax Administrator Resource Handler
 *
 * This class manages admin-user-related operations within the SecureFax system,
 * providing methods to create, and delete Administrators.
 * It handles all administrator-specific API endpoints and their corresponding requests.
 */
class SecureFaxManagerResource extends Resource
{

    /**
     * Creates a new administrator account with the given details.
     *
     * @param  string  $fullName  The full name of the administrator.
     * @param  string  $email  The email address of the administrator.
     * @param  string  $password  The password for the administrator account.
     * @param  string  $company  The company associated with the administrator.
     *
     * @return Response Returns the response from the connector after processing the request.
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function create(string $fullName, string $email, string $password, string $company): Response
    {
        return $this->connector->send(new CreateAdministratorRequest($fullName, $email, $password, $company));
    }
}
