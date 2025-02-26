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
 * Supports optional query parameters for pagination.
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
     * Query parameters for pagination and filtering.
     *
     * @var array<string, mixed>|null
     */
    protected ?array $queryParams = null;

    /**
     * Initialize a new users list request.
     *
     * @param  array<string, mixed>|null  $queryParams  Optional query parameters for filtering and pagination.
     *                                               Example: ['page' => 1, 'per_page' => 20]
     */
    public function __construct(?array $queryParams = null)
    {
        $this->queryParams = $queryParams;
    }

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

    /**
     * Define the query parameters for the request.
     *
     * This method structures the query parameters including optional pagination settings.
     * It removes any null or empty values from the final query array before making the request.
     *
     * @return array<string, mixed> The filtered query parameters for the API request.
     */
    public function defaultQuery(): array
    {
        return array_filter([
            'page' => $this->queryParams['page'] ?? 1,
        ]);
    }
}
