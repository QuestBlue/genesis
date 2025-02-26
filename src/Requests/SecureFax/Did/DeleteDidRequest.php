<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Requests\SecureFax\Did;

use QuestBlue\Genesis\Enums\Service;
use QuestBlue\Genesis\Requests\BaseRequest;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * DID Deletion Request Handler
 *
 * Manages the removal of Direct Inward Dialing (DID) numbers from the SecureFax system.
 * This handler processes the permanent deletion of DIDs, which will:
 * - Remove the DID from the system
 * - Disassociate it from any linked company
 * - Free up the number for potential future use
 */
class DeleteDidRequest extends BaseRequest implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method for this request
     *
     * @var Method
     */
    protected Method $method = Method::DELETE;

    /**
     * Initialize a new DID deletion request
     *
     * @param string $didId The unique identifier of the DID to be deleted
     */
    public function __construct(protected readonly string $didId, protected readonly string $companyId) {}

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
     * Construct the request payload for DID creation
     *
     * Builds an array containing all necessary and optional DID information
     * that will be converted to JSON for the request body.
     *
     * @return array{
     *     company: string,
     * }
     */
    protected function defaultBody(): array
    {
        return [
            'company'     => $this->companyId,
        ];
    }


    /**
     * Define the API endpoint for DID deletion
     *
     * Constructs the endpoint URL by incorporating the DID's
     * unique identifier into the deletion path.
     *
     * @return string The API endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/manager/did/$this->didId";
    }
}