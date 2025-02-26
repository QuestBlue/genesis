<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Enums;

/**
 * Service Configuration Enum
 *
 * Defines available API services and their corresponding endpoint URLs
 * for both live and sandbox environments.
 */
enum Service
{
    /**
     * SecureFax service identifier
     */
    case SECURE_FAX;

    /**
     * Get the production base URL for the service
     *
     * Provides the appropriate production API endpoint URL based on
     * the selected service.
     *
     * @return string The production environment base URL
     */
    public function liveBaseUrl(): string
    {
        return match ($this) {
            self::SECURE_FAX => 'https://api.questblue.com/v3/securefax/',
        };
    }

    /**
     * Get the sandbox base URL for the service
     *
     * Provides the appropriate testing/development API endpoint URL based on
     * the selected service.
     *
     * @return string The sandbox environment base URL
     */
    public function sandboxBaseUrl(): string
    {
        return match ($this) {
            self::SECURE_FAX => 'http://apiv3.test/v3/securefax/',
        };
    }
}