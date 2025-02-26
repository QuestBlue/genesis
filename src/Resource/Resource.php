<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Resource;

use QuestBlue\Genesis\Enums\Service;
use Saloon\Http\Connector;

/**
 * Base Resource Class
 *
 * This abstract base class serves as a foundation for all API resource classes.
 * It provides common functionality and structure for interacting with specific API endpoints.
 */
class Resource
{
    /**
     * The service type this resource belongs to
     */
    protected Service $service;

    /**
     * Initialize a new resource instance
     *
     * @param Connector $connector The API connector instance used for making HTTP requests
     */
    public function __construct(public Connector $connector) {}
}