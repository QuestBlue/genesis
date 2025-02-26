<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Requests;

use QuestBlue\Genesis\Enums\Service;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Base Request Class
 *
 * This abstract class serves as the foundation for all API requests in the system.
 * It defines common request behavior and enforces service specification for all
 * concrete request implementations.
 */
abstract class BaseRequest extends Request
{
    /**
     * The default HTTP method for API requests
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * Resolve the service for this request
     *
     * This method must be implemented by all concrete request classes to specify
     * which service they belong to. This information is used for routing and
     * configuration purposes.
     *
     * @return Service The service enum value that this request belongs to
     */
    abstract public function resolveService(): Service;
}
