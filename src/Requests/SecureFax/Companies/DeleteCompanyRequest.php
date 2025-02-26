<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Requests\SecureFax\Companies;

use QuestBlue\Genesis\Enums\Service;
use QuestBlue\Genesis\Requests\BaseRequest;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Delete Company Request Handler
 *
 * Handles the deletion of companies within the SecureFax system through the API.
 * This request sends a DELETE request to remove a specific company identified by
 * its unique company ID.
 */
class DeleteCompanyRequest extends BaseRequest implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method for this request
     *
     * @var Method
     */
    protected Method $method = Method::DELETE;

    /**
     * Initialize a new delete company request
     *
     * @param  string  $companyId  The unique identifier of the company to delete
     */
    public function __construct(
        protected readonly string $companyId,
    ) {}

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
     * Define the API endpoint for company deletion
     *
     * Constructs the endpoint URL by appending the company ID
     * to the base deletion endpoint.
     *
     * @return string The complete API endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/manager/company/delete/'.$this->companyId;
    }

    /**
     * Define the request body for company deletion
     *
     * Structures the request payload with the company ID required
     * for the deletion operation.
     *
     * @return array<string, string> The request payload as an associative array
     */
    protected function defaultBody(): array
    {
        return [
            'id' => $this->companyId,
        ];
    }
}
