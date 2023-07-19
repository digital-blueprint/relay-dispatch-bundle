<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Helpers\BlobSignatureTools;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\File\File;
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
            return BlobSignatureTools::create($this->blobKey, $payload);
        } catch (\JsonException $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be signed for blob storage!', 'dispatch:request-file-blob-signature-failure', ['message' => $e->getMessage()]);
        }
    }

    // TODO: Move to PHP library
    private function generateSha256ChecksumFromUrl($url): string
    {
        return hash('sha256', $url);
    }

    public function downloadRequestFileAsContentUrl(RequestFile $requestFile): string
    {
        $blobIdentifier = $requestFile->getData();

        $queryParams = [
            'bucketID' => $this->blobBucketId,
            'creationTime' => date('U'),
            'action' => 'GETONE',
            'binary' => 1,
        ];

        $url = $this->getSignedBlobFilesUrl($queryParams, $blobIdentifier);

        // https://github.com/digital-blueprint/relay-blob-bundle/blob/main/doc/api.md
        $client = new Client();
        try {
            $r = $client->request('GET', $url);
        } catch (GuzzleException $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be downloaded from Blob!', 'dispatch:request-file-blob-download-error', ['message' => $e->getMessage()]);
        }

        $result = $r->getBody()->getContents();
        $jsonData = json_decode($result, true);

        dump($jsonData);
        $contentUrl = $jsonData['contentUrl'] ?? '';

        if ($contentUrl === '') {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be downloaded from Blob!', 'dispatch:request-file-blob-download-error', ['message' => 'No contentUrl returned from Blob!']);
        }

        return $contentUrl;
    }

    // TODO: Move to PHP library (in a more general version)
    public function uploadRequestFile(string $dispatchRequestIdentifier, string $fileName, string $fileData): string
    {
        $queryParams = [
            'bucketID' => $this->blobBucketId,
            'creationTime' => date('U'),
            'prefix' => $this->getPrefix($dispatchRequestIdentifier),
            'action' => 'CREATEONE',
            'fileName' => $fileName,
            'fileHash' => hash('sha256', $fileData),
        ];

        $url = $this->getSignedBlobFilesUrl($queryParams);

        // Post to Blob
        // https://github.com/digital-blueprint/relay-blob-bundle/blob/main/doc/api.md
        $client = new Client();
        try {
            $r = $client->request('POST', $url, [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => $fileData,
                        'filename' => $fileName,
                    ],
                ],
            ]);
        } catch (GuzzleException $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be uploaded to Blob!', 'dispatch:request-file-blob-upload-error', ['message' => $e->getMessage()]);
        }

        $result = $r->getBody()->getContents();
        $jsonData = json_decode($result, true);
        $identifier = $jsonData['identifier'] ?? '';

        if ($identifier === '') {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be uploaded to Blob!', 'dispatch:request-file-blob-upload-error', ['message' => 'No identifier returned from Blob!']);
        }

        // Return the blob file ID
        return $identifier;
    }

    protected function getPrefix(string $dispatchRequestIdentifier): string
    {
        return 'Request/'.$dispatchRequestIdentifier;
    }

    protected function getSignedBlobFilesUrl(array $queryParams, string $blobIdentifier = ''): string
    {
        $path = '/blob/files';

        if ($blobIdentifier !== '') {
            $path .= '/'.urlencode($blobIdentifier);
        }

        // It's mandatory that "%20" is used instead of "+" for spaces in the query string, otherwise the checksum will be invalid!
        $urlPart = $path.'?'.http_build_query($queryParams, '', '&', PHP_QUERY_RFC3986);

        $checksum = $this->generateSha256ChecksumFromUrl($urlPart);

        $payload = [
            'cs' => $checksum,
        ];

        $token = $this->createBlobSignature($payload);

        return $this->blobBaseUrl.$urlPart.'&sig='.$token;
    }
}
