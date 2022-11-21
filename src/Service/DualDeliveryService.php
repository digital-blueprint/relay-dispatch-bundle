<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\DualDeliveryClient;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ApplicationID;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderProfile;
use Dbp\Relay\DispatchBundle\Helpers\Tools;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use Symfony\Component\Uid\Uuid;

/**
 * This wraps a fully configured DualDeliveryClient() and some bundle configuration and exposes
 * a simplified API for working with the SOAP client.
 */
class DualDeliveryService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private const APPLICATION_ID = 'relay-dispatch-bundle';
    private const APPLICATION_VERSION = '0.1';

    public function __construct()
    {
        $this->logger = new NullLogger();
    }

    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    public function getClient(): DualDeliveryClient
    {
        $config = $this->config;

        $baseUrl = $config['base_url'];
        $cert = $config['cert'];
        $certPassword = $config['cert_password'];

        $certFileName = Tools::getTempFileName('.pem');
        file_put_contents($certFileName, $cert);

        return new DualDeliveryClient($baseUrl, [$certFileName, $certPassword], true);
    }

    public function getSenderProfile(): SenderProfile
    {
        $config = $this->config;
        $profile = $config['sender_profile'];
        $profileVersion = $config['sender_profile_version'];

        return new SenderProfile($profile, $profileVersion);
    }

    public function getApplicationID(): ApplicationID
    {
        return new ApplicationID(self::APPLICATION_ID, self::APPLICATION_VERSION);
    }

    /**
     * Creates a new AppDeliveryID.
     * Every Request should have its own unique ID, so related requests/responses can be connected.
     */
    public function createAppDeliveryID(): string
    {
        // Use the format suggested in the official docs
        return 'ADID_'.self::APPLICATION_ID.'-'.(string) time().'-'.Uuid::v4()->toRfc4122();
    }

    /**
     * Creates a new RecipientID.
     */
    public function createRecipientID(): string
    {
        return 'RID_'.Uuid::v4()->toRfc4122();
    }
}
