<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Requests\SecureFax\User;

use JsonException;
use QuestBlue\Genesis\Data\SecureFax\UserData;
use QuestBlue\Genesis\Enums\Service;
use QuestBlue\Genesis\Requests\BaseRequest;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Administrator User Creation Request Handler
 *
 * Manages the creation of new administrator users in the SecureFax system.
 * This handler processes administrator account creation with:
 * - Basic user information (name, email)
 * - Authentication credentials
 * - Company association
 *
 * Administrators created through this endpoint will have full administrative
 * privileges for their assigned company.
 */
class CreateAdministratorRequest extends BaseRequest implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method for this request
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * Initialize a new administrator creation request
     *
     * @param  string|null  $fullName  The administrator's full name (optional)
     * @param  string  $email  The administrator's email address (used for login)
     * @param  string  $password  The administrator's initial password
     * @param  string  $company  The UUID of the company the administrator will manage
     */
    public function __construct(
        protected readonly ?string $fullName,
        protected readonly string $email,
        protected readonly string $password,
        protected readonly string $company,
    ) {}

    /**
     * Define the API endpoint for administrator creation
     *
     * @return string The API endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/manager/administrator';
    }

    /**
     * Resolves and returns the appropriate service.
     *
     * @return Service The resolved service instance.
     */
    public function resolveService(): Service
    {
        return Service::SECURE_FAX;
    }

    /**
     * Creates a Data Transfer Object (DTO) from the given response.
     *
     * @param  Response  $response  The HTTP response containing user data in JSON format
     *
     * @return mixed The created DTO from the response data
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): mixed
    {
        return UserData::fromArray($response->json('data.user'));
    }

    /**
     * Construct the request payload for administrator creation
     *
     * Builds an array containing all administrator information
     * that will be converted to JSON for the request body.
     *
     * @return array{
     *     fullname: string|null,
     *     email: string,
     *     password: string,
     *     company: string
     * }
     */
    protected function defaultBody(): array
    {
        return [
            'fullname' => $this->fullName,
            'email'    => $this->email,
            'password' => $this->password,
            'company'  => $this->company,
        ];
    }
}
