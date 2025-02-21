<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Requests\SecureFax\Companies;

use QuestBlue\Genesis\Data\SecureFax\CompanyData;
use QuestBlue\Genesis\Enums\Service;
use QuestBlue\Genesis\Requests\BaseRequest;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Company Unlock Request Handler
 *
 * Handles the process of unlocking a previously locked company in the SecureFax system.
 * When a company is unlocked, it restores normal access and allows modifications
 * to the company's resources.
 */
class UnlockCompanyRequest extends BaseRequest implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method for this request
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Initialize a new unlock company request
     *
     * @param string $companyId The unique identifier of the company to unlock
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
     * Define the API endpoint for unlocking a company
     *
     * Constructs the endpoint URL by incorporating the company ID
     * into the unlock endpoint path.
     *
     * @return string The complete API endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/manager/company/$this->companyId/unlock";
    }

    /**
     * Create a DTO from the API response
     *
     * Transforms the API response into a structured CompanyData object
     * containing the unlocked company's updated information.
     *
     * @param Response $response The API response
     * @return CompanyData The company data object with updated unlock status
     *
     * @throws \JsonException When JSON decoding fails
     */
    public function createDtoFromResponse(Response $response): mixed
    {
        return CompanyData::fromArray($response->json('data.company'));
    }
}