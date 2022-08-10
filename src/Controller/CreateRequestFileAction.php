<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Controller;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Service\DispatchService;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;

final class CreateRequestFileAction extends BaseDispatchController
{
    /**
     * @var DispatchService
     */
    private $dispatchService;

    public function __construct(DispatchService $dispatchService)
    {
        $this->dispatchService = $dispatchService;
    }

    /**
     * @throws HttpException
     */
    public function __invoke(Request $request): RequestFile
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_SCOPE_DISPATCH');

        $dispatchRequestIdentifier = self::requestGet($request, 'dispatchRequestIdentifier');

        if ($dispatchRequestIdentifier === null) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Missing "dispatchRequestIdentifier"!', 'dispatch:request-file-missing-request-identifier');
        }

        // Check if current person owns the request
        $this->dispatchService->getRequestByIdForCurrentPerson($dispatchRequestIdentifier);

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
