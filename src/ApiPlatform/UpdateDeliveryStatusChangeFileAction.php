<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\ApiPlatform;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class UpdateDeliveryStatusChangeFileAction extends AbstractController
{
    private DispatchService $dispatchService;

    private AuthorizationService $auth;

    public function __construct(DispatchService $dispatchService, AuthorizationService $auth)
    {
        $this->dispatchService = $dispatchService;
        $this->auth = $auth;
    }

    /**
     * @throws HttpException
     */
    public function __invoke(Request $request): DeliveryStatusChange
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->auth->checkCanUse();

        /** @var ?string $dispatchRequestIdentifier */
        $dispatchRequestIdentifier = $request->request->get('dispatchRequestIdentifier');
        if ($dispatchRequestIdentifier === null) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Missing "dispatchRequestIdentifier"!', 'dispatch:request-file-missing-request-identifier');
        }
        // Check if current person owns the request
        $dispatchRequest = $this->dispatchService->getRequestById($dispatchRequestIdentifier);
        $this->auth->checkCanWrite($dispatchRequest->getGroupId());

        $dispatchDeliveryStatusChangeIdentifier = $request->attributes->get('identifier');
        $dispatchDeliveryStatusChange = $this->dispatchService->getDeliveryStatusChangeById($dispatchDeliveryStatusChangeIdentifier);

        // Check if the status is allowed to upload receipt.
        if (!$dispatchDeliveryStatusChange->isInReceiptUploadAllowedStatus()) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Receipt can not be uploaded in this status!', 'dispatch:delivery-status-change-wrong-status-error');
        }

        /** @var ?UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('file');

        // check if there is an uploaded file
        if (!$uploadedFile) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'No file with parameter key "file" was received!', 'dispatch:request-file-missing-file');
        }

        // If the upload failed, figure out why
        if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, $uploadedFile->getErrorMessage(), 'dispatch:request-file-upload-error');
        }

        // check if file is a pdf
        if ($uploadedFile->getMimeType() !== 'application/pdf') {
            throw ApiError::withDetails(Response::HTTP_UNSUPPORTED_MEDIA_TYPE, 'Only PDF files can be added!', 'dispatch:request-file-only-pdf-files-allowed');
        }

        // check if file is empty
        if ($uploadedFile->getSize() === 0) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Empty files cannot be added!', 'dispatch:request-file-empty-files-not-allowed');
        }

        $uploadedFileContent = $uploadedFile->getContent();

        /** @var ?string $fileUploaderIdentifier */
        $fileUploaderIdentifier = $request->request->get('fileUploaderIdentifier');

        return $this->dispatchService->updateDeliveryStatusChangeFile($dispatchDeliveryStatusChange, $uploadedFileContent, $fileUploaderIdentifier);
    }
}
