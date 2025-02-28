<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Requests\SecureFax\User;

use QuestBlue\Genesis\Enums\Service;
use QuestBlue\Genesis\Requests\BaseRequest;
use Saloon\Enums\Method;

/**
 * Class ListUsersRequest
 *
 * Handles the request for retrieving a list of users within the SecureFax system.
 */
class ListUsersRequest extends BaseRequest
{
    /**
     * The HTTP method for this request.
     *
     * @var Method
     */
    protected Method $method = Method::GET;


    /**
     * Specify the service this request belongs to.
     *
     * @return Service The service enum value for SecureFax.
     */
    public function resolveService(): Service
    {
        return Service::SECURE_FAX;
    }

    /**
     * Define the API endpoint for retrieving users.
     *
     * @return string The API endpoint path for user retrieval.
     */
    public function resolveEndpoint(): string
    {
        return "/user";
    }
}
