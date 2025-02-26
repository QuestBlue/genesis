<?php

declare(strict_types=1);

namespace QuestBlue\Genesis\Resource\SecureFax;

use QuestBlue\Genesis\Requests\SecureFax\Companies\CreateCompanyRequest;
use QuestBlue\Genesis\Requests\SecureFax\Companies\DeleteCompanyRequest;
use QuestBlue\Genesis\Requests\SecureFax\Companies\GetCompaniesRequest;
use QuestBlue\Genesis\Requests\SecureFax\Companies\LockCompanyRequest;
use QuestBlue\Genesis\Requests\SecureFax\Companies\UnlockCompanyRequest;
use QuestBlue\Genesis\Resource\Resource;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;
use Throwable;

/**
 * SecureFax Company Resource Handler
 *
 * This class manages company-related operations within the SecureFax system,
 * providing methods to create, delete, lock, and unlock companies.
 * It handles all company-specific API endpoints and their corresponding requests.
 */
class SecureFaxCompanyResource extends Resource
{

    /**
     * Retrieve a list of companies from the SecureFax API.
     *
     * @param  array|null  $pagination  Optional pagination parameters (e.g., page, per_page).
     *
     * @return Response The API response containing the list of companies.
     *
     * @throws FatalRequestException If a fatal error occurs during the request.
     * @throws RequestException If the request fails due to client or server-side errors.
     * @throws Throwable If any other exception is thrown during execution.
     */
    public function list(?array $pagination = null): Response
    {
        return $this->connector->send(new GetCompaniesRequest($pagination));
    }

    /**
     * Create a new company in the SecureFax system.
     *
     * This method sends a request to create a new company with the specified name.
     * The created company will be available for secure fax operations.
     *
     * @param  string  $name  The name of the company to be created.
     *
     * @return Response The API response containing the details of the newly created company.
     *
     * @throws FatalRequestException If a fatal error occurs during the request.
     * @throws RequestException If the request fails due to client or server-side errors.
     * @throws Throwable If any other exception is thrown during execution.
     */
    public function create(string $name): Response
    {
        return $this->connector->send(new CreateCompanyRequest($name));
    }

    /**
     * Delete an existing company by its ID.
     *
     * This method permanently removes a company and all its associated data
     * from the SecureFax system. This action cannot be undone.
     *
     * @param  string  $id  The unique identifier of the company to be deleted.
     *
     * @return Response The API response confirming the deletion of the company.
     *
     * @throws FatalRequestException If a fatal error occurs during the request.
     * @throws RequestException If the request fails due to client or server-side errors.
     * @throws Throwable If any other exception is thrown during execution.
     */
    public function delete(string $id): Response
    {
        return $this->connector->send(new DeleteCompanyRequest($id));
    }

    /**
     * Lock a company by its ID.
     *
     * Locking a company prevents it from performing certain operations in the SecureFax system.
     * This is typically used for temporary suspension of company activities while maintaining
     * their data and configuration.
     *
     * @param  string  $id  The unique identifier of the company to be locked.
     *
     * @return Response The API response confirming the company has been locked.
     *
     * @throws FatalRequestException If a fatal error occurs during the request.
     * @throws RequestException If the request fails due to client or server-side errors.
     * @throws Throwable If any other exception is thrown during execution.
     */
    public function lock(string $id): Response
    {
        return $this->connector->send(new LockCompanyRequest($id));
    }

    /**
     * Unlock a company by its ID.
     *
     * Unlocking a company restores its full functionality in the SecureFax system,
     * allowing it to resume normal operations. This reverses the effects of the lock operation.
     *
     * @param  string  $id  The unique identifier of the company to be unlocked.
     *
     * @return Response The API response confirming the company has been unlocked.
     *
     * @throws FatalRequestException If a fatal error occurs during the request.
     * @throws RequestException If the request fails due to client or server-side errors.
     * @throws Throwable If any other exception is thrown during execution.
     */
    public function unlock(string $id): Response
    {
        return $this->connector->send(new UnlockCompanyRequest($id));
    }

}
