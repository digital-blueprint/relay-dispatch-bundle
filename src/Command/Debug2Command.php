<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\DualDeliveryService;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AbstractAddressType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AbstractPersonType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AdditionalMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AdditionalMetaDataSetType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AdditionalResults;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AdditonalResultSetType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AnyURI;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ApplicationID;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\BinaryDocumentType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DeliveryChannels;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DeliveryChannelSetType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\MetaData as DualDeliveryMetadata;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryCancellationRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPre\MetaData as PreMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressingRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualNotificationRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ParametersType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ParameterType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PayloadAttributesType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PayloadType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PersonDataType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PersonNameType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PhysicalPersonType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PrintParameter;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ProcessingProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PropertyValueMetaDataSetType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Recipient;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Recipients;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\RecipientType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\StatusRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\StatusType;
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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $config = $this->config;

        $baseUrl = $config['base_url'];
        $cert = $config['cert'];
        $certPassword = $config['cert_password'];
        $profile = $config['sender_profile'];

        $certFileName = Tools::getTempFileName('.pem');
        file_put_contents($certFileName, $cert);

        $service = new DualDeliveryService($baseUrl, [$certFileName, $certPassword], true);

        // Experiments
        $senderProfile = new SenderProfile($profile, '1.0');
        $sender = new SenderType($senderProfile);

        $physicalPerson = new PhysicalPersonType(new PersonNameType('Max', 'Mustermann'), '1970-06-04');
        $personData = new PersonDataType($physicalPerson);
        $recipient = new RecipientType($personData);
        $recipients = new Recipients([
            new Recipient('42', $recipient), ]);

        $meta = new PreMetaData(uniqid());
        $meta->setAdditionalMetaData(
            new AdditionalMetaData(
                new PropertyValueMetaDataSetType(new ParameterType('CampaignId', 'DUMMY'))));
        $meta->setTestCase(false);
        $meta->setProcessingProfile(new ProcessingProfile('ZuseDD', '1.1'));
        $meta->setAsynchronous(false);
        $meta->setPreCreateSendings(true);
        $applicationId = new ApplicationID($profile, '1.0');
        $meta->setApplicationID($applicationId);
        $request = new DualDeliveryPreAddressingRequestType($sender, $recipients, $meta, null, '1.0');
        $response = $service->dualDeliveryPreAddressingRequestOperation($request);
        var_dump($response);

        print_r($service->getPrettyLastResponse());

        // ---------------------------
        // dualStatusRequestOperation
        $applicationId = new ApplicationID($profile, '1.0');
        $request = new StatusRequestType($applicationId, 'bla');
        $response = $service->dualStatusRequestOperation($request);
        var_dump($response);

        // ---------------------------
        // dualDeliveryCancellationRequestOperation
        $request = new DualDeliveryCancellationRequest($profile, $applicationId, 'id', '1.0');
        $response = $service->dualDeliveryCancellationRequestOperation($request);
        var_dump($response);

        // ---------------------------
        // dualNotificationRequestOperation
        $res = new AdditionalResults(new AdditonalResultSetType());
        $status = new StatusType('code');
        $request = new DualNotificationRequest('foo', 'bar', $res, $status, '1.0');
        $response = $service->dualNotificationRequestOperation($request);
        var_dump($response);

        // ---------------------------
        // dualDeliveryRequestOperation
        $person = new AbstractPersonType('bla', 'id');
        $addr = new AbstractAddressType('id');
        $senderProfile = new SenderProfile($profile, '1.0');
        $parameters = new ParametersType(new ParameterType('bla', 'foo'));
        $sender = new SenderType($senderProfile);
        $person2 = new PersonDataType($person, $addr);
        $recipientType = new RecipientType($person2, $parameters);
        $addMeta = new AdditionalMetaData(new AdditionalMetaDataSetType());
        $processingProfile = new ProcessingProfile('bla', '1.0');
        $meta = new DualDeliveryMetaData('bla', $applicationId, 'ok', 'bla', 'GZ', null, $addMeta, true, $processingProfile, 'doc', false, 0, 'user', 'token');
        $channels = new DeliveryChannels(new DeliveryChannelSetType());
        $print = new PrintParameter('bla', new AnyURI('ok'));
        $payloadAttrs = new PayloadAttributesType('foo', 'bar', $parameters, $print);
        $doc = new BinaryDocumentType('content');
        $payload = new PayloadType($payloadAttrs, $doc);
        $request = new DualDeliveryRequest($sender, 'id', $recipientType, $meta, $channels, $payload, '1.0');
        $response = $service->dualDeliveryRequestOperation($request);
        var_dump($response);

        // ---------------------------
        // DualDeliveryPreAddressingRequestType
        $recipients = new Recipients([new Recipient('id', $recipientType)]);
        $request = new DualDeliveryPreAddressingRequestType($sender, $recipients, new PreMetaData('id'), $channels, '1.0');
        $response = $service->dualDeliveryPreAddressingRequestOperation($request);
        var_dump($response);

        return 0;
    }
}
