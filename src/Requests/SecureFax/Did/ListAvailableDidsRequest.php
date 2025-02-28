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
 * Class ListAvailableDidsRequest
 *
 * Handles the request for retrieving a list of Direct Inward Dialing (DID) numbers
 * available to be routed to a SecureFax company.
 */
class ListAvailableDidsRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method for the request.
     *
     * @var Method
     */
    protected Method $method = Method::GET;

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
        return "/did/available";
    }

}
