<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\Relay\BlobLibrary\Api\BlobApi;
use Dbp\Relay\BlobLibrary\Helpers\Error;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BlobService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var mixed
     */
    private $blobKey;
    /**
     * @var mixed
     */
    private $blobBucketId;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var string
     */
    private $blobBaseUrl;

    /**
     * @var BlobApi
     */
    private $blobApi;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
        $this->blobBaseUrl = '';
        $this->blobKey = '';
        $this->blobBucketId = '';
    }

    public function setConfig(array $config)
    {
        $this->blobBaseUrl = $config['blob_base_url'] ?? '';
        $this->blobKey = $config['blob_key'] ?? '';
        $this->blobBucketId = $config['blob_bucket_id'] ?? '';
        $this->blobApi = new BlobApi($this->blobBaseUrl, $this->blobBucketId, $this->blobKey);
    }

    public function createBlobSignature($payload): string
    {
//        $payload = [
//            'bucketID' => $this->blobBucketId,
//            'creationTime' => date('U'),
//            'prefix' => $this->getPrefix($dispatchRequestIdentifier),
//            'filename' => $fileName,
//            'file' => hash('sha256', $fileData),
//            'metadata' => [],
//        ];

        try {
            return $this->blobApi->createBlobSignature($payload);
        } catch (Error $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be signed for blob storage!', 'dispatch:request-file-blob-signature-failure', ['message' => $e->getMessage()]);
        }
    }

    public function deleteBlobFileByRequestFile(RequestFile $requestFile): void
    {
        $blobIdentifier = $requestFile->getFileStorageIdentifier();

        try {
            $this->blobApi->deleteBlobFileByIdentifier($blobIdentifier);
        } catch (Error $e) {
            $requestFileIdentifier = $requestFile->getIdentifier();
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be deleted from Blob!', 'dispatch:request-file-blob-delete-error', ['request-file-identifier' => $requestFileIdentifier, 'message' => $e->getMessage()]);
        }
    }

    public function deleteBlobFilesByRequest(Request $request): void
    {
        $dispatchRequestIdentifier = $request->getIdentifier();

        try {
            $this->blobApi->deleteBlobFilesByPrefix($this->getPrefix($dispatchRequestIdentifier));
        } catch (Error $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFiles could not be deleted from Blob!', 'dispatch:request-file-blob-delete-error', ['request-identifier' => $dispatchRequestIdentifier, 'message' => $e->getMessage()]);
        }
    }

    public function downloadRequestFileAsContentUrl(RequestFile $requestFile): string
    {
        $blobIdentifier = $requestFile->getFileStorageIdentifier();

        try {
            $contentUrl = $this->blobApi->downloadFileAsContentUrlByIdentifier($blobIdentifier);
        } catch (Error $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be downloaded from Blob!', 'dispatch:request-file-blob-download-error', ['message' => $e->getMessage()]);
        }

        return $contentUrl;
    }

    public function uploadRequestFile(string $dispatchRequestIdentifier, string $fileName, string $fileData): string
    {
        try {
            $identifier = $this->blobApi->uploadFile($dispatchRequestIdentifier, $fileName, $fileData);
        } catch (Error $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be uploaded to Blob!', 'dispatch:request-file-blob-upload-error', ['message' => $e->getMessage()]);
        }

        // Return the blob file ID
        return $identifier;
    }

    protected function getPrefix(string $dispatchRequestIdentifier): string
    {
        return 'Request/'.$dispatchRequestIdentifier;
    }
}
