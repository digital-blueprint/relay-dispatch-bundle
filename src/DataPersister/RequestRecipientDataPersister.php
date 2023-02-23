<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RequestRecipientDataPersister extends AbstractController implements ContextAwareDataPersisterInterface
{
    /**
     * @var DispatchService
     */
    private $dispatchService;
    /**
     * @var AuthorizationService
     */
    private $auth;

    public function __construct(DispatchService $dispatchService, AuthorizationService $auth)
    {
        $this->dispatchService = $dispatchService;
        $this->auth = $auth;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof RequestRecipient;
    }

    /**
     * @param mixed $data
     *
     * @return RequestRecipient
     */
    public function persist($data, array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        $requestRecipient = $data;
        assert($requestRecipient instanceof RequestRecipient);

        // Check if current person owns the request
        $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());

        $this->auth->checkCanWrite($request->getGroupId());

        // On PUT requests, we need to check if the person identifier has been changed to an empty string.
        // If so, we need to clear the birthdate, street address, postal code, address locality and address country
        // in the database to prevent the user from being able to see the previously hidden personal data of the person.
        if ($context['item_operation_name'] === 'put') {
            $pastRequestRecipient = $context['previous_data'];
            assert($pastRequestRecipient instanceof RequestRecipient);

            $personIdentifier = trim($requestRecipient->getPersonIdentifier() ?? '');
            $pastPersonIdentifier = trim($pastRequestRecipient->getPersonIdentifier() ?? '');

            if ($personIdentifier === '' && $pastPersonIdentifier !== $personIdentifier) {
                $requestRecipient->setBirthDate(null);
                $requestRecipient->setStreetAddress('');
                $requestRecipient->setPostalCode('');
                $requestRecipient->setAddressLocality('');
                $requestRecipient->setAddressCountry('');
            }
        }

        $this->dispatchService->handleRequestRecipientStorage($requestRecipient);

        return $requestRecipient;
    }

    /**
     * @param mixed $data
     *
     * @return void
     */
    public function remove($data, array $context = [])
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        $requestRecipient = $data;
        assert($requestRecipient instanceof RequestRecipient);

        // Check if current person owns the request
        $request = $this->dispatchService->getRequestById($requestRecipient->getDispatchRequestIdentifier());

        $this->auth->checkCanWrite($request->getGroupId());

        if ($request->isSubmitted()) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
        }

        $this->dispatchService->removeRequestRecipientById($requestRecipient->getIdentifier());
    }
}
