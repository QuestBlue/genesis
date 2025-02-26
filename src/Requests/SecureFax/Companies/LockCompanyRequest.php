<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Requests\SecureFax\Companies;

use JsonException;
use QuestBlue\Genesis\Data\SecureFax\CompanyData;
use QuestBlue\Genesis\Enums\Service;
use QuestBlue\Genesis\Requests\BaseRequest;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Company Lock Request Handler
 *
 * Handles the process of locking a company in the SecureFax system through the API.
 * When a company is locked, it typically prevents further modifications or access
 * to the company's resources.
 */
class LockCompanyRequest extends BaseRequest implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method for this request
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Initialize a new lock company request
     *
     * @param  string  $companyId  The unique identifier of the company to lock
     */
    public function __construct(protected readonly string $companyId) {}

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
     * Define the API endpoint for locking a company
     *
     * Constructs the endpoint URL by incorporating the company ID
     * into the lock endpoint path.
     *
     * @return string The complete API endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/manager/company/$this->companyId/lock";
    }

    /**
     * Create a DTO from the API response
     *
     * Transforms the API response into a structured CompanyData object
     * containing the locked company's updated information.
     *
     * @param  Response  $response  The API response
     *
     * @return CompanyData The company data object with updated lock status
     *
     * @throws JsonException When JSON decoding fails
     */
    public function createDtoFromResponse(Response $response): mixed
    {
        return CompanyData::fromArray($response->json('data.company'));
    }
}
