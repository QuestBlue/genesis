<?php

declare(strict_types=1);

namespace QuestBlue\Genesis;

use QuestBlue\Genesis\Enums\Service;
use QuestBlue\Genesis\Exceptions\GenesisException;
use QuestBlue\Genesis\Resource\SecureFax\SecureFaxResource;
use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Auth\HeaderAuthenticator;
use Saloon\Http\Auth\MultiAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\PendingRequest;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Plugins\AcceptsJson;
use Throwable;

/**
 * QuestBlue API Connector
 *
 * This class serves as the main connector for interacting with the QuestBlue API.
 * It handles authentication, request creation, and provides access to various API resources.
 */
class Genesis extends Connector
{
    use AcceptsJson;

    /**
     * The current service being accessed
     */
    protected Service $service;

    /**
     * Initialize a new Genesis API connector instance
     *
     * @param string|null $username API username for basic authentication
     * @param string|null $password API password for basic authentication
     * @param string|null $apiKey Security key for header authentication
     * @param bool $sandbox Whether to use sandbox environment
     */
    public function __construct(
        protected ?string $username = null,
        protected ?string $password = null,
        protected ?string $apiKey = null,
        protected ?bool $sandbox = false
    ) {
    }

    /**
     * Configure the default authentication for API requests
     *
     * Combines both basic auth (username/password) and header auth (API key)
     *
     * @return MultiAuthenticator
     */
    protected function defaultAuth(): MultiAuthenticator
    {
        return new MultiAuthenticator(
            new BasicAuthenticator($this->username, $this->password),
            new HeaderAuthenticator($this->apiKey, 'Security-key'),
        );
    }

    /**
     * Resolve the base URL for the QuestBlue API.
     *
     * @return string The base URL of the QuestBlue API.
     */
    public function resolveBaseUrl(): string
    {
        return $this->isSandboxEnvironment() ? $this->service->sandboxBaseUrl() : $this->service->liveBaseUrl();
    }

    /**
     * Creates a pending request with the appropriate service configuration
     *
     * @param Request $request The request to be processed
     * @param MockClient|null $mockClient Optional mock client for testing
     * @return PendingRequest
     */
    public function createPendingRequest(Request $request, MockClient $mockClient = null): PendingRequest
    {
        $this->configureServiceFromRequest($request);
        return parent::createPendingRequest($request, $mockClient);
    }


    /**
     * Configure the service based on the given request.
     *
     * @param  Request  $request  The request containing the service configuration.
     *
     * @return void
     */
    private function configureServiceFromRequest(Request $request): void
    {
        $this->service($request->resolveService());
    }


    /**
     * Set the service to be used for API requests
     *
     * @param Service $service The service to be used
     * @return self
     */
    public function service(Service $service): self
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Set the username for API authentication
     *
     * @param string $username The username to be used
     * @return self
     */
    public function username(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Set the password for API authentication
     *
     * @param string $password The password to be used
     * @return self
     */
    public function password(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Set the API key for header authentication
     *
     * @param string $apiKey The API key to be used
     * @return self
     */
    public function apiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Set whether to use sandbox environment
     *
     * @param bool $sandbox True to use sandbox environment, false for production
     * @return self
     */
    public function sandbox(bool $sandbox): self
    {
        $this->sandbox = $sandbox;
        return $this;
    }

    /**
     * Check if the current environment is sandbox
     *
     * @return bool
     */
    private function isSandboxEnvironment(): bool
    {
        return $this->sandbox;
    }

    /**
     * Get an instance of the SecureFax resource
     *
     * @return SecureFaxResource
     */
    public function secureFax(): SecureFaxResource
    {
        return new SecureFaxResource($this);
    }

    /**
     * Retrieve the request exception based on the response and an optional sender exception.
     *
     * @param  Response  $response  The response object that provides details about the request.
     * @param  Throwable|null  $senderException  An optional exception that originated from the sender.
     *
     * @return Throwable|null The exception generated based on the response, or null if not applicable.
     */
    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        return new GenesisException($response);
    }

}