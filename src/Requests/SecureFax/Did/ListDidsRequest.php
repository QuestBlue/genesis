<?php

namespace QuestBlue\Genesis\Requests\SecureFax\Did;

use QuestBlue\Genesis\Data\SecureFax\Did\DidListData;
use QuestBlue\Genesis\Enums\Service;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Class ListDidsRequest
 *
 * Handles the request for retrieving a list of Direct Inward Dialing (DID) numbers
 * associated with a SecureFax company.
 */
class ListDidsRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method for the request.
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * ListDidsRequest constructor.
     *
     * @param string $companyId The ID of the SecureFax company for which DID numbers should be retrieved.
     */
    public function __construct(protected readonly string $companyId) {}

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
     * Resolve the endpoint URL for the request.
     *
     * @return string The endpoint URI for retrieving the list of DID numbers.
     */
    public function resolveEndpoint(): string
    {
        return "/did/$this->companyId";
    }

    /**
     * Parse the response into a DidListResponse DTO.
     *
     * @param array $data The raw API response data.
     *
     * @return DidListData The structured DTO representing the DID list.
     */
    public function createDtoFromResponse(Response $response): mixed
    {
        return DidListData::fromArray($response->json());
    }
}
