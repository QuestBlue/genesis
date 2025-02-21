<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Requests\SecureFax\Companies;

use QuestBlue\Genesis\Enums\Service;
use QuestBlue\Genesis\Requests\BaseRequest;
use Saloon\Enums\Method;

/**
 * Companies List Request Handler
 *
 * Handles retrieving the list of companies from the SecureFax API.
 * Supports pagination through query parameters to control the result set size
 * and page number.
 */
class GetCompaniesRequest extends BaseRequest
{
    /**
     * The HTTP method for this request
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Pagination parameters for the request
     *
     * @var array<string, mixed>|null
     */
    protected ?array $pagination = null;

    /**
     * Initialize a new companies list request
     *
     * @param array<string, mixed>|null $pagination Optional pagination parameters
     *                                             Example: ['page' => 1, 'limit' => 20]
     */
    public function __construct(?array $pagination = null)
    {
        $this->pagination = $pagination;
    }

    /**
     * Specify the service this request belongs to
     *
     * @return Service The service enum value for SecureFax
     */
    public function resolveService(): Service
    {
        return Service::SECURE_FAX;
    }

    /**
     * Define the API endpoint for retrieving companies
     *
     * @return string The API endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/manager/company";
    }

    /**
     * Define the query parameters for the request
     *
     * Structures the query parameters including optional pagination settings.
     * Removes any null or empty values from the final query array.
     *
     * @return array<string, mixed> The filtered query parameters
     */
    public function defaultQuery(): array
    {
        return array_filter([
            'Pagination' => $this->pagination,
        ]);
    }
}