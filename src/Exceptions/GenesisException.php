<?php

namespace QuestBlue\Genesis\Exceptions;

use Exception;
use Saloon\Http\Response as SaloonResponse;
use Throwable;

/**
 * Class GenesisException
 *
 * This exception is thrown when an error occurs while interacting with the Genesis API.
 * It extracts error messages from API responses and provides structured error handling.
 *
 * @package QuestBlue\Genesis\Exceptions
 */
class GenesisException extends Exception
{
    /**
     * The Saloon response instance associated with this exception.
     *
     * @var SaloonResponse
     */
    protected SaloonResponse $response;

    /**
     * GenesisException constructor.
     *
     * @param SaloonResponse $response The API response containing error details.
     */
    public function __construct(SaloonResponse $response)
    {
        parent::__construct(self::extractErrorMessage($response));
        $this->response = $response;
    }

    /**
     * Extracts the error message from the API response.
     *
     * @param SaloonResponse $response The response from the API.
     * @return string The extracted error message or a default message if unavailable.
     */
    private static function extractErrorMessage(SaloonResponse $response): string
    {
        if ($response->successful()) {
            return 'Unexpected successful response received';
        }

        try {
            $data = $response->json('message');
            return $data ?? 'An unknown error occurred';
        } catch (Throwable $e) {
            return 'Error extracting response message: ' . $response->body();
        }
    }

    /**
     * Retrieves the original API response associated with this exception.
     *
     * @return SaloonResponse The API response that triggered the exception.
     */
    public function getResponse(): SaloonResponse
    {
        return $this->response;
    }
}
