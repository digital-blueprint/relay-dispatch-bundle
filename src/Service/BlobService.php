<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\Relay\BlobLibrary\Api\BlobApi;
use Dbp\Relay\BlobLibrary\Api\BlobApiError;
use Dbp\Relay\BlobLibrary\Api\BlobFile;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BlobService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private array $config = [];
    private ?BlobApi $blobApi = null;

    public function __construct(
        private readonly UrlGeneratorInterface $router,
        #[Autowire(service: 'service_container')]
        private readonly ContainerInterface $container)
    {
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    private function getBlobApi(): BlobApi
    {
        if ($this->blobApi === null) {
            try {
                $this->blobApi = BlobApi::createFromConfig($this->config, $this->container);
            } catch (BlobApiError $blobApiError) {
                $this->logBlobApiError($blobApiError);
                throw new \RuntimeException('Failed to create BlobApi', 0, $blobApiError);
            }
        }

        return $this->blobApi;
    }

    public function deleteBlobFileByRequestFile(RequestFile $requestFile): void
    {
        $this->removeFile($requestFile->getFileStorageIdentifier());
    }

    public function deleteBlobFileByDeliveryStatusChange(DeliveryStatusChange $statusChange): void
    {
        $this->removeFile($statusChange->getFileStorageIdentifier());
    }

    public function deleteBlobFilesByRequest(Request $request): void
    {
        try {
            $this->getBlobApi()->removeFiles([
                BlobApi::PREFIX_OPTION => self::getBlobPrefix($request->getIdentifier()),
            ]);
        } catch (BlobApiError $blobApiError) {
            $this->logBlobApiError($blobApiError);
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR,
                'RequestFiles could not be deleted from Blob!',
                'dispatch:request-file-blob-delete-error',
                ['request-identifier' => $request->getIdentifier()]);
        }
    }

    public function downloadRequestFileAsContentUrl(RequestFile $requestFile): string
    {
        return $this->getFileContentUrl($requestFile->getFileStorageIdentifier());
    }

    public function downloadDeliveryStatusChangeFileAsContentUrl(DeliveryStatusChange $deliveryStatusChange): string
    {
        return $this->getFileContentUrl($deliveryStatusChange->getFileStorageIdentifier());
    }

    public function uploadRequestFile(string $dispatchRequestIdentifier, string $fileName, string $fileData): string
    {
        return $this->addFile($dispatchRequestIdentifier, $fileName, $fileData);
    }

    /**
     * @throws \Exception
     */
    public function uploadDeliveryStatusChangeFile(string $dispatchRequestIdentifier, string $fileName, string $fileData): string
    {
        return $this->addFile($dispatchRequestIdentifier, $fileName, $fileData);
    }

    protected static function getBlobPrefix(string $dispatchRequestIdentifier): string
    {
        return 'request-'.$dispatchRequestIdentifier;
    }

    private function addFile(string $dispatchRequestIdentifier, string $fileName, string $fileData): string
    {
        try {
            $blobFile = new BlobFile();
            $blobFile->setFileName($fileName);
            $blobFile->setFile($fileData);
            $blobFile->setPrefix(self::getBlobPrefix($dispatchRequestIdentifier));

            return $this->getBlobApi()->addFile($blobFile)->getIdentifier();
        } catch (BlobApiError $blobApiError) {
            $this->logBlobApiError($blobApiError);
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR,
                'File could not be uploaded to Blob!',
                'dispatch:blob-upload-error');
        }
    }

    protected function getFileContentUrl(string $fileStorageIdentifier): string
    {
        try {
            return $this->getBlobApi()->getFile($fileStorageIdentifier, [BlobApi::INCLUDE_FILE_CONTENTS_OPTION => true])
                ->getContentUrl() ?? '';
        } catch (BlobApiError $blobApiError) {
            $this->logBlobApiError($blobApiError);
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR,
                'RequestFile could not be downloaded from Blob!',
                'dispatch:request-file-blob-download-error', ['message' => $blobApiError->getMessage()]);
        }
    }

    protected function removeFile(string $fileStorageIdentifier): void
    {
        try {
            $this->getBlobApi()->removeFile($fileStorageIdentifier);
        } catch (BlobApiError $blobApiError) {
            if ($blobApiError->getErrorId() !== BlobApiError::FILE_NOT_FOUND) {
                $this->logBlobApiError($blobApiError);
                throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR,
                    'RequestFile could not be deleted from Blob!', 'dispatch:request-file-blob-delete-error',
                    ['request-file-identifier' => $fileStorageIdentifier, 'message' => $blobApiError->getMessage()]);
            }
        }
    }

    private function logBlobApiError(BlobApiError $blobApiError): void
    {
        $this->logger->error(sprintf('Failed to upload file to Blob: %s. Error ID: %s. Status code: %d. Blob Error ID: %s ',
            $blobApiError->getMessage(), $blobApiError->getErrorId(), $blobApiError->getStatusCode(), $blobApiError->getBlobErrorId()));
    }
}
