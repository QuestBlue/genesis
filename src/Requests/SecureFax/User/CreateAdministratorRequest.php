<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Requests\SecureFax\User;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
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
class CreateAdministratorRequest extends Request implements HasBody
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
     * @param string|null $fullname The administrator's full name (optional)
     * @param string      $email    The administrator's email address (used for login)
     * @param string      $password The administrator's initial password
     * @param string      $company  The UUID of the company the administrator will manage
     */
    public function __construct(
        protected readonly ?string $fullname,
        protected readonly string $email,
        protected readonly string $password,
        protected readonly string $company,
    ) {}

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
            'fullname' => $this->fullname,
            'email'    => $this->email,
            'password' => $this->password,
            'company'  => $this->company,
        ];
    }

    /**
     * Define the API endpoint for administrator creation
     *
     * @return string The API endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/manager/user';
    }
}