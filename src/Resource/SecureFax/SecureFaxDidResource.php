<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Resource\SecureFax;

use QuestBlue\Genesis\Requests\SecureFax\Did\CreateDidRequest;
use QuestBlue\Genesis\Requests\SecureFax\Did\DeleteDidRequest;
use QuestBlue\Genesis\Resource\Resource;
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
    public function delete(string $didId, string $companyId): Response
    {
        return $this->connector->send(new DeleteDidRequest($didId, $companyId));
    }
}
