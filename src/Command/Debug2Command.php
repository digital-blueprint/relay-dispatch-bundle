<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Command;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\BinaryDocumentType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\Checksum;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\DualDeliveryRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\DualDeliveryResponse;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\MetaData as DualDeliveryMetadata;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\PayloadAttributesType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\PayloadType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ProcessingProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\RecipientType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\SenderType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\DualNotificationRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\StatusRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\DeliveryAddress;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\FamilyName;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PersonDataType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PersonNameType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PhysicalPersonType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PostalAddressType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\DualDeliveryPreAddressingRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\DualDeliveryPreAddressingResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\MetaData as PreMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\Recipient;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\Recipients;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Vendo\DeliveryQuality;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Vendo\ProcessingProfile as VendoProcessingProfile;
use Dbp\Relay\DispatchBundle\Service\DualDeliveryService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Debug2Command extends Command
{
    protected static $defaultName = 'dbp:relay-dispatch:debug2';
    /**
     * @var DualDeliveryService
     */
    private $dd;

    private const GIVEN_NAME = 'Max';
    private const FAMILY_NAME = 'Mustermann';
    private const DATE_OF_BIRTH = '1970-06-04';
    private const POSTAL_CODE = '8010';
    private const MUNICIPALITY = 'Graz';
    private const STREET_NAME = 'Brockmanngasse 41';
    private const BUILDING_NUMBER = '';
    private const COUNTRY_CODE = 'AT';

    private const PROCESSING_PROFILE = VendoProcessingProfile::ZUSE_DD;
    private const DELIVERY_QUALITY = DeliveryQuality::RSA;

    public function __construct(DualDeliveryService $dd)
    {
        parent::__construct();

        $this->dd = $dd;
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setDescription('Debug command');
    }

    protected function doRequest(): DualDeliveryResponse
    {
        $client = $this->dd->getClient();
        $senderProfile = $this->dd->getSenderProfile();

        $physicalPerson = new PhysicalPersonType(new PersonNameType(self::GIVEN_NAME, new FamilyName(self::FAMILY_NAME)), self::DATE_OF_BIRTH);
        $personData = new PersonDataType($physicalPerson);
        $address = new PostalAddressType(
            null,
            self::POSTAL_CODE, self::MUNICIPALITY,
            new DeliveryAddress(self::STREET_NAME, self::BUILDING_NUMBER)
        );
        $address->setCountryCode(self::COUNTRY_CODE);
        $dualDeliveryRecipient = new RecipientType($personData);

        $data = file_get_contents(__DIR__.'/../../tests/DualDeliveryApi/example.pdf');
        $payloadAttrs = new PayloadAttributesType('example.pdf', 'application/pdf');
        $payloadAttrs->setChecksum(new Checksum('MD5', md5($data)));
        $doc = new BinaryDocumentType($data);
        $dualDeliveryPayloads = [new PayloadType($payloadAttrs, $doc)];

        $sender = new SenderType($senderProfile);

        $processingProfile = new ProcessingProfile(self::PROCESSING_PROFILE, VendoProcessingProfile::VERSION_STANDARD);

        $meta = new DualDeliveryMetaData(
            $this->dd->createAppDeliveryID(),
            $this->dd->getApplicationID(),
            self::DELIVERY_QUALITY,
            'Test',
            '4242 424242-42',
            null,
            null,
            false,
            $processingProfile,
            null,
            true
        );

        $request = new DualDeliveryRequest($sender, null, $dualDeliveryRecipient, $meta, null, $dualDeliveryPayloads, '1.0');

        $response = $client->dualDeliveryRequestOperation($request);
        var_dump($client->getPrettyLastResponse());
        dump($response);

        return $response;
    }

    protected function doPrAddr(): DualDeliveryPreAddressingResponseType
    {
        $client = $this->dd->getClient();
        $senderProfile = $this->dd->getSenderProfile();

        $sender = new SenderType($senderProfile);

        $physicalPerson = new PhysicalPersonType(new PersonNameType(self::GIVEN_NAME, new FamilyName(self::FAMILY_NAME)), self::DATE_OF_BIRTH);
        $personData = new PersonDataType($physicalPerson);
        $recipient = new RecipientType($personData);
        $recipients = new Recipients([
            new Recipient($this->dd->createRecipientID(), $recipient), ]);

        $meta = new PreMetaData($this->dd->createAppDeliveryID());
        $meta->setTestCase(false);
        $meta->setProcessingProfile(new ProcessingProfile(self::PROCESSING_PROFILE, VendoProcessingProfile::VERSION_PRE_ADDRESSING));
        $meta->setAsynchronous(false);
        $meta->setPreCreateSendings(true);
        $request = new DualDeliveryPreAddressingRequestType($sender, $recipients, $meta, null, '1.0');
        $response = $client->dualDeliveryPreAddressingRequestOperation($request);
        var_dump($client->getPrettyLastResponse());
        dump($response);

        return $response;
    }

    protected function doStatusRequest(string $appDeliveryId): DualNotificationRequestType
    {
        $client = $this->dd->getClient();
        $request = new StatusRequestType($this->dd->getApplicationID(), $appDeliveryId, null);
        $response = $client->dualStatusRequestOperation($request);
        var_dump($client->getPrettyLastResponse());
        dump($response);

        return $response;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->doPrAddr();
        $response2 = $this->doRequest();
        $this->doStatusRequest($response2->getAppDeliveryID());

        return 0;
    }
}
