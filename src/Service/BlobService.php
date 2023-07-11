<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Helpers\BlobSignatureTools;
use GuzzleHttp\Client;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Uid\Uuid;

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
     * @var string|null
     */
    private $blobFilesUrl;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
        $this->blobKey = '';
        $this->blobBucketId = '';
        $this->blobFilesUrl = null;
    }

    public function setConfig(array $config)
    {
        $this->blobKey = $config['blob_key'] ?? '';
        $this->blobBucketId = $config['blob_bucket_id'] ?? '';
    }


    public function createBlobSignature(string $dispatchRequestIdentifier, string $fileName, string $fileData): string {
        $payload = [
            'bucketID' => $this->blobBucketId,
            'creationTime' => date('U'),
            'prefix' => $this->getPrefix($dispatchRequestIdentifier),
            'filename' => $fileName,
            'file' => hash('sha256', $fileData),
            'metadata' => [],
        ];

        try {
            return BlobSignatureTools::create($this->blobKey, $payload);
        } catch (\JsonException $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be signed for blob storage!', 'dispatch:request-file-blob-signature-failure', ['message' => $e->getMessage()]);
        }
    }

    public function getBlobFilesUrl(): string
    {
        if ($this->blobFilesUrl !== null) {
            return $this->blobFilesUrl;
        }

        $this->blobFilesUrl = $this->router->generate('api_blob_files_post_collection', [], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->blobFilesUrl;
    }

    public function uploadRequestFile(string $dispatchRequestIdentifier, string $fileName, string $fileData): string
    {
        dump($this->blobKey);
        dump($this->blobBucketId);

        $token = $this->createBlobSignature($dispatchRequestIdentifier, $fileName, $fileData);
        dump($token);

        // Post to Blob
        // https://github.com/digital-blueprint/relay-blob-bundle/blob/main/doc/api.md
        $client = new Client();
        $url = $this->getBlobFilesUrl();

        // Provide the body as a string.
        // TODO: Fix "Failed to connect to 127.0.0.1 port 8000: Connection refused"
        $r = $client->request('POST', $url, [
            'query' => [
                'bucketID' => $this->blobBucketId,
                'creationTime' => date('U'),
                'prefix' => $this->getPrefix($dispatchRequestIdentifier),
                'action' => 'CREATEONE',
                'fileName' => $fileName,
                'fileHash' => hash('sha256', $fileData),
                'sig' => $token
            ],
            'form_params' => [
                'file' => $fileData,
                'prefix' => $this->getPrefix($dispatchRequestIdentifier),
                'fileName' => $fileName,
                'bucketID' => $this->blobBucketId,
            ]
        ]);

        dump($url);
        dump($r);

        // TODO: Return the blob file ID
        return '';
    }

    /**
     * @param string $dispatchRequestIdentifier
     * @return string
     */
    protected function getPrefix(string $dispatchRequestIdentifier): string
    {
        return 'Request/'.$dispatchRequestIdentifier;
    }
}
