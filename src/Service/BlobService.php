<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\Relay\BlobLibrary\Api\BlobApi;
use Dbp\Relay\BlobLibrary\Api\BlobApiError;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Exception;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BlobService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private ?string $blobKey = null;
    private ?string $blobBucketId = null;

    private ?string $blobBaseUrl = null;
    private ?string $blobIdpUrl = null;
    private ?string $blobOauthClientId = null;
    private ?string $blobOauthClientSecret = null;

    private ?BlobApi $blobApi = null;

    public function __construct(private readonly UrlGeneratorInterface $router)
    {
    }

    public function setConfig(array $config): void
    {
        $this->blobBaseUrl = $config['blob_base_url'] ?? '';
        $this->blobKey = $config['blob_key'] ?? '';
        $this->blobBucketId = $config['blob_bucket_id'] ?? '';

        $this->blobIdpUrl = $config['blob_idp_url'] ?? '';
        $this->blobOauthClientId = $config['blob_oauth_client_id'] ?? '';
        $this->blobOauthClientSecret = $config['blob_oauth_client_secret'] ?? '';
    }

    private function getApi(): BlobApi
    {
        if ($this->blobApi === null) {
            $api = new BlobApi($this->blobBaseUrl, $this->blobBucketId, $this->blobKey);
            if ($this->blobIdpUrl !== '' && $this->blobOauthClientId !== '' && $this->blobOauthClientSecret !== '') {
                try {
                    $api->setOAuth2Token($this->blobIdpUrl, $this->blobOauthClientId, $this->blobOauthClientSecret);
                } catch (BlobApiError $e) {
                    throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'OAuth2 token for blob could not be retrieved!', 'dispatch:get-blob-oauth2-token-error', ['message' => $e->getMessage()]);
                }
            }
            $this->blobApi = $api;
        }

        return $this->blobApi;
    }

    public function deleteBlobFileByRequestFile(RequestFile $requestFile): void
    {
        $blobIdentifier = $requestFile->getFileStorageIdentifier();
        $api = $this->getApi();

        try {
            // Note that 404 error will be handled (and ignored) in the blob library
            $api->deleteFileByIdentifier($blobIdentifier);
        } catch (BlobApiError $e) {
            $requestFileIdentifier = $requestFile->getIdentifier();
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be deleted from Blob!', 'dispatch:request-file-blob-delete-error', ['request-file-identifier' => $requestFileIdentifier, 'message' => $e->getMessage()]);
        }
    }

    public function deleteBlobFileByDeliveryStatusChange(DeliveryStatusChange $statusChange): void
    {
        $blobIdentifier = $statusChange->getFileStorageIdentifier();
        $api = $this->getApi();

        try {
            $api->deleteFileByIdentifier($blobIdentifier);
        } catch (BlobApiError $e) {
            $identifier = $statusChange->getIdentifier();
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'DeliveryStatusChange file could not be deleted from Blob!', 'dispatch:delivery-status-change-file-blob-delete-error', ['delivery-status-change-identifier' => $identifier, 'message' => $e->getMessage()]);
        }
    }

    public function deleteBlobFilesByRequest(Request $request): void
    {
        $dispatchRequestIdentifier = $request->getIdentifier();
        $api = $this->getApi();

        try {
            // This will delete blob files for request files and delivery status changes
            // TODO: In the future we need to make sure that all files are deleted if deleteFilesByPrefix returns that there will be more files to delete
            $api->deleteFilesByPrefix($this->getBlobPrefix($dispatchRequestIdentifier));
        } catch (BlobApiError $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFiles could not be deleted from Blob!', 'dispatch:request-file-blob-delete-error', ['request-identifier' => $dispatchRequestIdentifier, 'message' => $e->getMessage()]);
        }
    }

    public function downloadRequestFileAsContentUrl(RequestFile $requestFile): string
    {
        $blobIdentifier = $requestFile->getFileStorageIdentifier();
        $api = $this->getApi();

        try {
            $contentUrl = $api->downloadFileAsContentUrlByIdentifier($blobIdentifier);
        } catch (BlobApiError $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be downloaded from Blob!', 'dispatch:request-file-blob-download-error', ['message' => $e->getMessage()]);
        }

        return $contentUrl;
    }

    public function downloadDeliveryStatusChangeFileAsContentUrl(DeliveryStatusChange $deliveryStatusChange): string
    {
        $blobIdentifier = $deliveryStatusChange->getFileStorageIdentifier();
        $api = $this->getApi();

        try {
            $contentUrl = $api->downloadFileAsContentUrlByIdentifier($blobIdentifier);
        } catch (BlobApiError $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'File of the DeliveryStatusChange could not be downloaded from Blob!', 'dispatch:delivery-status-change-blob-download-error', ['message' => $e->getMessage()]);
        }

        return $contentUrl;
    }

    public function uploadRequestFile(string $dispatchRequestIdentifier, string $fileName, string $fileData): string
    {
        $api = $this->getApi();

        try {
            $identifier = $api->uploadFile($this->getRequestFileBlobPrefix($dispatchRequestIdentifier), $fileName, $fileData);
        } catch (BlobApiError $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be uploaded to Blob!', 'dispatch:request-file-blob-upload-error', ['message' => $e->getMessage()]);
        }

        // Return the blob file ID
        return $identifier;
    }

    /**
     * @throws \Exception
     */
    public function uploadDeliveryStatusChangeFile(string $dispatchRequestIdentifier, string $fileName, string $fileData): string
    {
        $api = $this->getApi();

        try {
            $identifier = $api->uploadFile($this->getDeliveryStatusChangeBlobPrefix($dispatchRequestIdentifier), $fileName, $fileData);
        } catch (BlobApiError $e) {
            // We don't care a lot about what exception we're throwing here, because we will just
            // store the file in the database if there are any issues with the blob storage
            throw new \Exception($e->getMessage());
        }

        // Return the blob file ID
        return $identifier;
    }

    protected function getBlobPrefix(string $dispatchRequestIdentifier): string
    {
        return 'request-'.$dispatchRequestIdentifier;
    }

    protected function getRequestFileBlobPrefix(string $dispatchRequestIdentifier): string
    {
        return $this->getBlobPrefix($dispatchRequestIdentifier);
    }

    protected function getDeliveryStatusChangeBlobPrefix(string $dispatchRequestIdentifier): string
    {
        // In the end we decided to use the same method as for request files,
        // because we want to optimize for deleting requests
        return $this->getBlobPrefix($dispatchRequestIdentifier);
    }
}
