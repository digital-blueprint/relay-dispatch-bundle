<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Controller;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Dbp\Relay\DispatchBundle\Service\DualDeliveryService;
use Symfony\Component\HttpFoundation\Response;

class DownloadDeliveryStatusChangeFileController extends BaseDispatchController
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

    public function index(string $identifier): Response
    {
        if (!$identifier) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Missing "identifier"!', 'dispatch:delivery-status-change-file-missing-identifier');
        }

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//        dump($this->dispatchService->getCurrentPerson());
//
        $deliveryStatusChange = $this->dispatchService->getDeliveryStatusChangeById($identifier);
        $requestRecipient = $deliveryStatusChange->getDispatchRequestRecipient();
//        dump($requestRecipient->getDispatchRequest()->getGroupId());
        $this->auth->checkCanReadContent($requestRecipient->getDispatchRequest()->getGroupId());

        $fileData = $deliveryStatusChange->getFileData();
        $fileName = $requestRecipient->getFullName().'.'.DualDeliveryService::DOCUMENT_FILE_EXTENSION;

        $response = new Response($fileData);
        $response->headers->set('Content-Type', $deliveryStatusChange->getFileFormat());
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$fileName.'"');

        return $response;
    }
}
