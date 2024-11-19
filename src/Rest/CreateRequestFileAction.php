<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Rest;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Rest\CustomControllerTrait;
use Dbp\Relay\DispatchBundle\Authorization\AuthorizationService;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class CreateRequestFileAction extends AbstractController
{
    use CustomControllerTrait;

    public function __construct(
        private readonly DispatchService $dispatchService,
        private readonly AuthorizationService $authorizationService)
    {
    }

    /**
     * @throws HttpException
     */
    public function __invoke(Request $request): RequestFile
    {
        $this->requireAuthentication();
        $this->authorizationService->checkCanUse();

        /** @var ?string */
        $dispatchRequestIdentifier = $request->request->get('dispatchRequestIdentifier');

        if ($dispatchRequestIdentifier === null) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Missing "dispatchRequestIdentifier"!', 'dispatch:request-file-missing-request-identifier');
        }

        // Check if current person owns the request
        $dispatchRequest = $this->dispatchService->getRequestById($dispatchRequestIdentifier);

        $this->authorizationService->checkCanWrite($dispatchRequest->getGroupId());

        if ($dispatchRequest->isSubmitted()) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
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

        return $this->dispatchService->createRequestFile($uploadedFile, $dispatchRequestIdentifier);
    }
}
