<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\DualDeliveryService;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AdditionalMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\BinaryDocumentType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Checksum;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\MetaData as DualDeliveryMetadata;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPre\MetaData as PreMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressingRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressingResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryResponse;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualNotificationRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ParameterType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PayloadAttributesType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PayloadType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PersonDataType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PersonNameType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PhysicalPersonType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ProcessingProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PropertyValueMetaDataSetType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Recipient;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Recipients;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\RecipientType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\StatusRequestType;
use Dbp\Relay\DispatchBundle\Helpers\Tools;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Debug2Command extends Command
{
    protected static $defaultName = 'dbp:relay-dispatch:debug2';
    private $config;

    public function __construct()
    {
        parent::__construct();

        $this->config = [];
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setDescription('Debug command');
    }

    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    protected function getService(): DualDeliveryService
    {
        $config = $this->config;

        $baseUrl = $config['base_url'];
        $cert = $config['cert'];
        $certPassword = $config['cert_password'];

        $certFileName = Tools::getTempFileName('.pem');
        file_put_contents($certFileName, $cert);

        return new DualDeliveryService($baseUrl, [$certFileName, $certPassword], true);
    }

    protected function getSenderProfile(): SenderProfile
    {
        $config = $this->config;
        $profile = $config['sender_profile'];

        return new SenderProfile($profile, '1.0');
    }

    protected function doRequest(): DualDeliveryResponse
    {
        $service = $this->getService();
        $senderProfile = $this->getSenderProfile();

        $physicalPerson = new PhysicalPersonType(new PersonNameType('Max', 'Mustermann'), '1970-06-04');
        $personData = new PersonDataType($physicalPerson);
        $dualDeliveryRecipient = new RecipientType($personData);

        $data = file_get_contents(__DIR__.'/../../tests/DualDeliveryApi/example.pdf');
        $payloadAttrs = new PayloadAttributesType('example.pdf', 'application/pdf');
        $payloadAttrs->setId('foobar-'.uniqid());
        $payloadAttrs->setChecksum(new Checksum('MD5', md5($data)));
        $doc = new BinaryDocumentType($data);
        $dualDeliveryPayloads = [new PayloadType($payloadAttrs, $doc)];

        $sender = new SenderType($senderProfile);
        $processingProfile = new ProcessingProfile('ZuseDD', '1.0');

        $meta = new DualDeliveryMetaData(
            'foo-'.uniqid(),
            null,
            'Rsa',
            'k thx bye',
            '1120 110874-016',
            null,
            null,
            false,
            $processingProfile,
            null,
            true
        );

        $request = new DualDeliveryRequest($sender, null, $dualDeliveryRecipient, $meta, null, $dualDeliveryPayloads, '1.0');

        $response = $service->dualDeliveryRequestOperation($request);
        var_dump($service->getPrettyLastResponse());
        dump($response);

        return $response;
    }

    protected function doPrAddr(): DualDeliveryPreAddressingResponseType
    {
        $service = $this->getService();
        $senderProfile = $this->getSenderProfile();

        $sender = new SenderType($senderProfile);

        $physicalPerson = new PhysicalPersonType(new PersonNameType('Max', 'Mustermann'), '1970-06-04');
        $personData = new PersonDataType($physicalPerson);
        $recipient = new RecipientType($personData);
        $recipients = new Recipients([
            new Recipient('42', $recipient), ]);

        $meta = new PreMetaData('foo-'.uniqid());
        $meta->setAdditionalMetaData(
            new AdditionalMetaData(
                new PropertyValueMetaDataSetType(new ParameterType('CampaignId', 'DUMMY'))));
        $meta->setTestCase(false);
        $meta->setProcessingProfile(new ProcessingProfile('ZuseDD', '1.1'));
        $meta->setAsynchronous(false);
        $meta->setPreCreateSendings(true);
        $request = new DualDeliveryPreAddressingRequestType($sender, $recipients, $meta, null, '1.0');
        $response = $service->dualDeliveryPreAddressingRequestOperation($request);
        var_dump($service->getPrettyLastResponse());
        dump($response);

        return $response;
    }

    protected function doStatusRequest(string $appDeliveryId): DualNotificationRequestType
    {
        $service = $this->getService();
        $request = new StatusRequestType(null, $appDeliveryId, null);
        $response = $service->dualStatusRequestOperation($request);
        var_dump($service->getPrettyLastResponse());
        dump($response);

        return $response;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $service = $this->getService();

        $this->doPrAddr();
        $response2 = $this->doRequest();
        $this->doStatusRequest($response2->getAppDeliveryID());

        return 0;
    }
}
