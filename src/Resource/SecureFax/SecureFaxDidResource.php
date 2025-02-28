<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Resource\SecureFax;

use QuestBlue\Genesis\Requests\SecureFax\Did\CreateDidRequest;
use QuestBlue\Genesis\Requests\SecureFax\Did\DeleteDidRequest;
use QuestBlue\Genesis\Requests\SecureFax\Did\ListAvailableDidsRequest;
use QuestBlue\Genesis\Requests\SecureFax\Did\ListDidsRequest;
use QuestBlue\Genesis\Resource\Resource;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

/**
 * Class SecureFaxDidResource
 *
 * Handles operations related to SecureFax DIDs (Direct Inward Dialing).
 * Provides methods for creating and deleting DIDs within the SecureFax system.
 *
 * @package QuestBlue\Genesis\Resource\SecureFax
 */
class SecureFaxDidResource extends Resource
{

    /**
     * Retrieve a list of DIDs for a specified company.
     *
     * This method sends a request to the SecureFax API to fetch all DIDs associated with a given company.
     *
     * @param string $companyId The ID of the company whose DIDs should be listed.
     *
     * @return Response The API response containing the list of DIDs.
     *
     * @throws FatalRequestException If a fatal error occurs during the request.
     * @throws RequestException If the request fails due to client or server-side errors.
     */
    public function list(string $companyId): Response
    {
        return $this->connector->send(new ListDidsRequest($companyId));
    }

    /**
     * Retrieve a list of available DIDs for the authenticated QuestBlue user.
     *
     * This method sends a request to the QuestBlue API to fetch all DIDs available to be routed.
     *
     * @return Response The API response containing the list of DIDs.
     *
     * @throws FatalRequestException If a fatal error occurs during the request.
     * @throws RequestException If the request fails due to client or server-side errors.
     */
    public function available(): Response
    {
        return $this->connector->send(new ListAvailableDidsRequest());
    }

    /**
     * Create a new DID in the SecureFax system.
     *
     * Sends a request to create a new DID (Direct Inward Dialing) number.
     *
     * @param string      $number      The telephone number to assign as a DID.
     * @param string      $company     The company ID associated with the DID.
     * @param string|null $description An optional description for the DID.
     * @param string|null $name        An optional name label for the DID.
     *
     * @return Response The API response containing the newly created DID details.
     */
    public function create(string $number, string $company, string $description = null, string $name = null): Response
    {
        return $this->connector->send(new CreateDidRequest($number, $company, $description, $name));
    }

    /**
     * Delete an existing DID from the SecureFax system.
     *
     * Sends a request to remove a DID by its identifier and company ID.
     *
     * @param string $didId     The unique identifier of the DID to be deleted.
     * @param string $companyId The company ID associated with the DID.
     *
     * @return Response The API response confirming the deletion status.
     */
    public function delete(string $didId): Response
    {
        return $this->connector->send(new DeleteDidRequest($didId));
    }
}
