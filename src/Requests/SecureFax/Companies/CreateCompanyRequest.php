<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Requests\SecureFax\Companies;

use QuestBlue\Genesis\Data\SecureFax\CompanyData;
use QuestBlue\Genesis\Enums\Service;
use QuestBlue\Genesis\Requests\BaseRequest;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create Company Request Handler
 *
 * Handles the creation of a new company in the SecureFax system through the API.
 * This request sends company information to the SecureFax API and processes
 * the response to create a corresponding CompanyData object.
 */
class CreateCompanyRequest extends BaseRequest implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method for this request
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * Initialize a new create company request
     *
     * @param string $name The name of the company to create
     */
    public function __construct(protected readonly string $name) {}

    /**
     * Define the request body for company creation
     *
     * Structures the request payload with the company name and any other
     * required parameters for company creation.
     *
     * @return array<string, mixed> The request payload as an associative array
     */
    protected function defaultBody(): array
    {
        return ['name' => $this->name];
    }

    /**
     * Define the API endpoint for company creation
     *
     * @return string The API endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/manager/company/create';
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
     * Create a DTO from the API response
     *
     * Transforms the API response into a structured CompanyData object
     * for easier data handling in the application.
     *
     * @param Response $response The API response
     * @return CompanyData The created company data object
     *
     * @throws \JsonException When JSON decoding fails
     */
    public function createDtoFromResponse(Response $response): mixed
    {
        return CompanyData::fromArray($response->json('data.company'));
    }
}