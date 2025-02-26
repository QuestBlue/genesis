<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Requests\SecureFax\Did;

use QuestBlue\Genesis\Enums\Service;
use QuestBlue\Genesis\Requests\BaseRequest;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * DID Creation Request Handler
 *
 * Manages the creation of new Direct Inward Dialing (DID) numbers in the SecureFax system.
 * DIDs are telephone numbers that route incoming calls to specific destinations within
 * a company's phone system.
 *
 * This request handler facilitates:
 * - Assignment of DID numbers to companies
 * - Optional naming and description of DIDs
 * - Integration with the SecureFax management API
 */
class CreateDidRequest extends BaseRequest implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method for this request
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * Initialize a new DID creation request
     *
     * @param  string  $number  The telephone number to be registered as DID
     * @param  string  $company  The company's unique identifier (UUID)
     * @param  string|null  $description  Optional description to identify the DID's purpose
     * @param  string|null  $name  Optional friendly name for the DID
     */
    public function __construct(
        protected readonly string $number,
        protected readonly string $company,
        protected readonly ?string $description = null,
        protected readonly ?string $name = null
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
     * Define the API endpoint for DID creation
     *
     * @return string The API endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/manager/did";
    }

    /**
     * Construct the request payload for DID creation
     *
     * Builds an array containing all necessary and optional DID information
     * that will be converted to JSON for the request body.
     *
     * @return array{
     *     number: string,
     *     company: string,
     *     description: string|null,
     *     name: string|null
     * }
     */
    protected function defaultBody(): array
    {
        return [
            'number'      => $this->number,
            'company'     => $this->company,
            'description' => $this->description,
            'name'        => $this->name,
        ];
    }
}
