<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Helpers\BlobSignatureTools;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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

    private function generateSha256ChecksumFromUrl($url): string
    {
        return hash('sha256', $url);
    }

    public function uploadRequestFile(string $dispatchRequestIdentifier, string $fileName, string $fileData): string
    {
//        $fileData = $file->getContent();
//        $fileName = $file instanceof UploadedFile ? $file->getClientOriginalName() : $file->getFilename();

        dump($this->blobKey);
        dump($this->blobBucketId);
//        dump($file);
        dump($fileName);

        $queryParams = [
            'bucketID' => $this->blobBucketId,
            'creationTime' => date('U'),
            'prefix' => $this->getPrefix($dispatchRequestIdentifier),
            'action' => 'CREATEONE',
            'fileName' => $fileName,
            'fileHash' => hash('sha256', $fileData),
        ];

        $urlPart = '/blob/files' . '?'.http_build_query($queryParams);

        dump($urlPart);

        $checksum = $this->generateSha256ChecksumFromUrl($urlPart);
        dump($checksum);
        $payload = [
            'cs' => $checksum,
        ];

        $token = $this->createBlobSignature($payload);
        dump($token);

        // Post to Blob
        // https://github.com/digital-blueprint/relay-blob-bundle/blob/main/doc/api.md
        $client = new Client();
        $url = $this->blobBaseUrl.$urlPart.'&sig='.$token;

        dump($url);

        // Provide the body as a string.
        // TODO: Fix "Checksum invalid" error
        try {
            $r = $client->request('POST', $url, [
//                'headers' => [
//                    'Content-Type' => 'application/ld+json',
//                ],
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => $fileData,
                        'filename' => $fileName
                    ],
                ],
                'query' => [
                    'bucketID' => $this->blobBucketId,
                    'creationTime' => date('U'),
                    'prefix' => $this->getPrefix($dispatchRequestIdentifier),
                    'action' => 'CREATEONE',
                    'fileName' => $fileName,
                    'fileHash' => hash('sha256', $fileData),
                    'sig' => $token,
                ],
//                'body' => "HTTP_ACCEPT: application/ld+json\r\n" . 'file='.base64_encode($fileData),
//                'json' => [
//                    'file' => $file,
//                    'prefix' => $this->getPrefix($dispatchRequestIdentifier),
//                    'fileName' => $fileName,
//                    'bucketID' => $this->blobBucketId,
//                ],
//                'form_params' => [
//                    'file' => $file,
//                    'prefix' => $this->getPrefix($dispatchRequestIdentifier),
//                    'fileName' => $fileName,
//                    'bucketID' => $this->blobBucketId,
//                ],
            ]);
        } catch (GuzzleException $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not uploaded to Blob!', 'dispatch:request-file-blob-upload-error', ['message' => $e->getMessage()]);
        }

        dump($r);

        // TODO: Return the blob file ID
        return '';
    }

    protected function getPrefix(string $dispatchRequestIdentifier): string
    {
        return 'Request/'.$dispatchRequestIdentifier;
    }
}
