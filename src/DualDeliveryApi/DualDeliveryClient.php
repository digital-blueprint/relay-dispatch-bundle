<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\DualDeliveryRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\DualDeliveryResponse;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk\DualDeliveryBulkRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk\DualDeliveryBulkResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk\DualNotificationBulkRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk\DualNotificationBulkResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryCancellation\DualDeliveryCancellationRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryCancellation\DualDeliveryCancellationResponse;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\DualNotificationRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\DualNotificationRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\DualNotificationResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\StatusRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\DualDeliveryPreAddressingRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\DualDeliveryPreAddressingResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo\ApiProvider as VendoApiProvider;
use DOMDocument;

class DualDeliveryClient extends \SoapClient
{
    private static $classmap = [
        'DualDeliveryPersonData' => [
            'AbstractAddressType',
            'AbstractPersonType',
            'CorporateBodyType',
            'DeliveryAddress',
            'FamilyName',
            'ForAttentionOf',
            'IdentificationType',
            'InternetAddressType',
            'PersonDataType',
            'PersonNameType',
            'PhysicalPersonType',
            'PostalAddressType',
            'TelcomNumberType',
            'TelephoneAddressType',
        ],
        'Zuse' => [
            'AdditionalFormat',
            'Affix',
            'BinaryConfirmation',
            'DeliveryAnswerType',
            'DeliveryConfirmationType',
            'DeliveryNotification',
            'DeliveryNotificationACK',
            'DeliveryNotificationACKType',
            'DeliveryNotificationType',
            'DeliveryRequestStatus',
            'DeliveryRequestStatusACK',
            'DeliveryRequestStatusACKType',
            'DeliveryRequestStatusType',
            'DeliveryRequestType',
            'DocumentClass',
            'DocumentReference',
            'Error',
            'ErrorInfo',
            'Identification',
            'NotificationAddress',
            'NotificationsPerformed',
            'Organisation',
            'ReferencesType',
            'Success',
            'Value',
            'WebserviceURL',
        ],
        'XMLDsig' => [
            'SignatureType',
            'SignatureValueType',
            'SignedInfoType',
            'CanonicalizationMethodType',
            'CryptoBinary',
            'SignatureMethodType',
            'ReferenceType',
            'TransformsType',
            'TransformType',
            'DigestMethodType',
            'KeyInfoType',
            'KeyValueType',
            'RetrievalMethodType',
            'X509DataType',
            'X509IssuerSerialType',
            'PGPDataType',
            'SPKIDataType',
            'ObjectType',
            'ManifestType',
            'SignaturePropertiesType',
            'SignaturePropertyType',
            'DSAKeyValueType',
            'RSAKeyValueType',
        ],
        'EBInterface' => [
            'AddressIdentifierTypeType',
            'AccountType',
            'AdditionalInformationType',
            'AddressIdentifierType',
            'AddressType',
            'ArticleNumberType',
            'BankCodeCType',
            'BillerExtensionType',
            'BillerType',
            'ClassificationType',
            'CountryType',
            'CustomType',
            'DeliveryExtensionType',
            'DeliveryType',
            'DetailsExtensionType',
            'DetailsType',
            'DirectDebitType',
            'DiscountType',
            'FurtherIdentificationType',
            'InvoiceRecipientExtensionType',
            'InvoiceRecipientType',
            'InvoiceRootExtensionType',
            'InvoiceType',
            'ItemListType',
            'ItemType',
            'ListLineItemExtensionType',
            'ListLineItemType',
            'NoPaymentType',
            'OrderingPartyExtensionType',
            'OrderingPartyType',
            'OrderReferenceDetailType',
            'OrderReferenceType',
            'OtherTaxType',
            'PaymentConditionsExtensionType',
            'PaymentConditionsType',
            'PaymentMethodExtensionType',
            'PaymentMethodType',
            'PaymentReferenceType',
            'PeriodType',
            'PresentationDetailsExtensionType',
            'PresentationDetailsType',
            'ReductionAndSurchargeBaseType',
            'ReductionAndSurchargeDetailsExtensionType',
            'ReductionAndSurchargeDetailsType',
            'ReductionAndSurchargeListLineItemDetailsType',
            'ReductionAndSurchargeType',
            'TaxExtensionType',
            'TaxRateType',
            'TaxType',
            'UnitType',
            'UniversalBankTransactionType',
            'VATType',
            'ArticleNumberTypeType',
            'CountryCodeType',
            'CurrencyType',
            'DocumentTypeType',
            'LanguageType',
        ],
        'SAML' => [
            'ActionType',
            'AdviceType',
            'AssertionType',
            'AttributeDesignatorType',
            'AttributeStatementType',
            'AttributeType',
            'AudienceRestrictionConditionType',
            'AuthenticationStatementType',
            'AuthorityBindingType',
            'AuthorizationDecisionStatementType',
            'ConditionAbstractType',
            'ConditionsType',
            'DecisionType',
            'EvidenceType',
            'NameIdentifierType',
            'StatementAbstractType',
            'SubjectConfirmationType',
            'SubjectLocalityType',
            'SubjectStatementAbstractType',
            'SubjectType',
        ],
        'DualDeliveryNotification' => [
            'AdditionalPrintResultSetType',
            'AdditionalResults',
            'AdditonalPrintResults',
            'AdditonalResultSetType',
            'BinaryDocument',
            'Costs',
            'DelivererInformation',
            'DetailedCosts',
            'DualNotificationRequest',
            'DualNotificationRequestType',
            'DualNotificationResponseType',
            'EDeliveryNotificationType',
            'NotificationChannel',
            'NotificationChannelSetType',
            'OtherNotificationType',
            'PostalNotificationType',
            'PropertyValueAdditonalResultSetType',
            'PropertyValuePrintResultSetType',
            'Result',
            'ScannedData',
            'StatusRequestType',
        ],
        'DualDeliveryBulk' => [
            'BulkElements',
            'DualDeliveryBulkRequestType',
            'DualDeliveryBulkResponseType',
            'DualNotificationBulkRequestType',
            'DualNotificationBulkResponseType',
            'DualNotificationResponses',
            'FinishBulk',
            'Sender',
        ],
        'DualDelivery' => [
            'AccountInfo',
            'AdditionalMetaData',
            'AdditionalMetaDataSetType',
            'AdditionalPrintParameter',
            'AdditionalPrintParameterSetType',
            'ApplicationID',
            'BinaryDocumentType',
            'Checksum',
            'CustomNotificationIntervals',
            'DeliveryChannels',
            'DeliveryChannelSetType',
            'Depositor',
            'DocumentReferenceType',
            'DocumentType',
            'DualDeliveryRequest',
            'DualDeliveryRequestType',
            'DualDeliveryResponse',
            'DualDeliveryResponseType',
            'ElectronicDeliveryType',
            'EMailDeliveryType',
            'ErrorsType',
            'ErrorType',
            'ExtensionPointType',
            'GeneralAditionalPrintParameterType',
            'GetVersionRequest',
            'GetVersionResponse',
            'IdReferenceType',
            'InternationalAccount',
            'LocalAccount',
            'LocalFileReferenceType',
            'ManipulatedPayloadsType',
            'OtherDeliveryType',
            'ParameterSet',
            'ParametersType',
            'ParameterType',
            'PayloadAttributesType',
            'PayloadType',
            'PrintParameter',
            'Payment',
            'PaymentForm',
            'Payments',
            'PostalDeliveryType',
            'PrintedEnvelope',
            'ProcessingProfile',
            'PropertyValueMetaDataSetType',
            'PropertyValuePrintParameterSetType',
            'RecipientNotification',
            'RecipientType',
            'SenderData',
            'SenderProfile',
            'SenderType',
            'StatusType',
            'UsedDeliveryChannels',
            'UsedDeliveryChannelType',
            'Receiver',
        ],
        'DualDeliveryPreAddressing' => [
            'AddressingResult',
            'AddressingResults',
            'DualDeliveryPreAddressingRequestType',
            'DualDeliveryPreAddressingResponseType',
            'Recipient',
            'Recipients',
        ],
        'DualDeliveryCancellation' => [
            'DualDeliveryCancellationRequest',
            'DualDeliveryCancellationRequestType',
            'DualDeliveryCancellationResponse',
            'DualDeliveryCancellationResponseType',
        ],
    ];

    /**
     * @var string
     */
    private $origLocation;

    /**
     * @var ApiProviderInterface
     */
    private $provider;

    private static function getProviderForLocation(string $location): ApiProviderInterface
    {
        $host = parse_url($location, PHP_URL_HOST);
        if ($host === false) {
            throw new \RuntimeException('failed to parse location');
        }
        $providers = [new VendoApiProvider()];
        foreach ($providers as $provider) {
            if (in_array($host, $provider->getDomains(), true)) {
                return $provider;
            }
        }

        return new FallbackApiProvider();
    }

    public function getPrettyLastRequest(): string
    {
        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($this->__getLastRequest());

        return $dom->saveXML();
    }

    public function getPrettyLastResponse(): string
    {
        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($this->__getLastResponse());

        return $dom->saveXML();
    }

    public function getClassMap(): array
    {
        $classmap = [];
        foreach (self::$classmap as $namespace => $entries) {
            foreach ($entries as $name) {
                if (array_key_exists($name, $classmap)) {
                    throw new \RuntimeException('Duplicate classmap name: '.$name);
                }
                $classmap[$name] = __NAMESPACE__.'\\Types\\'.$namespace.'\\'.$name;
            }
        }

        return $classmap;
    }

    /**
     * @param array|string|null $cert either a path to a PEM file, or an array with a path and a password
     */
    public function __construct(string $location, $cert = null, $trace = false)
    {
        $options = [];
        $options['classmap'] = $this->getClassMap();

        $this->origLocation = $location;
        $this->provider = self::getProviderForLocation($location);

        $wsdl_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'wsdl'.DIRECTORY_SEPARATOR.'DualeZustellung.wsdl';

        $options = array_merge([
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'location' => $location,
            'trace' => $trace,
            'stream_context' => stream_context_create($this->provider->getStreamContextOptions()),
        ], $options);

        // If you have a .p12 file convert it to PEM using:
        //   openssl pkcs12 -in in.p12 -out ou.pem -clcerts
        if ($cert !== null) {
            if (is_string($cert)) {
                $options['local_cert'] = $cert;
            }
            assert(is_array($cert));
            $options['local_cert'] = $cert[0];
            $options['passphrase'] = $cert[1];
        }

        \SoapClient::__construct($wsdl_path, $options);
    }

    /*
     * @return mixed
     */
    private function callInternal(string $operationName, array $args)
    {
        // This sets the location based on the SOAP function call name
        $operationPath = $this->provider->getPathForOperation($operationName);
        if ($operationPath === null) {
            throw new \SoapFault('Server', get_class($this->provider)." doesn't provide ".$operationName);
        }
        $newLocation = rtrim($this->origLocation, '/').$operationPath;
        $this->__setLocation($newLocation);

        return $this->__soapCall($operationName, $args);
    }

    public function dualDeliveryRequestOperation(DualDeliveryRequest $DualDeliveryRequest): DualDeliveryResponse
    {
        return $this->callInternal('dualDeliveryRequestOperation', [$DualDeliveryRequest]);
    }

    public function dualNotificationRequestOperation(DualNotificationRequest $DualNotificationRequest): DualNotificationResponseType
    {
        return $this->callInternal('dualNotificationRequestOperation', [$DualNotificationRequest]);
    }

    public function dualStatusRequestOperation(StatusRequestType $StatusRequest): DualNotificationRequestType
    {
        return $this->callInternal('dualStatusRequestOperation', [$StatusRequest]);
    }

    public function dualDeliveryBulkRequestOperation(DualDeliveryBulkRequestType $DualDeliveryBulkRequest): DualDeliveryBulkResponseType
    {
        return $this->callInternal('dualDeliveryBulkRequestOperation', [$DualDeliveryBulkRequest]);
    }

    public function dualNotificationBulkRequestOperation(DualNotificationBulkRequestType $DualNotificationBulkRequest): DualNotificationBulkResponseType
    {
        return $this->callInternal('dualNotificationBulkRequestOperation', [$DualNotificationBulkRequest]);
    }

    public function dualDeliveryPreAddressingRequestOperation(DualDeliveryPreAddressingRequestType $DualDeliveryPreAddressingRequest): DualDeliveryPreAddressingResponseType
    {
        return $this->callInternal('dualDeliveryPreAddressingRequestOperation', [$DualDeliveryPreAddressingRequest]);
    }

    public function dualDeliveryCancellationRequestOperation(DualDeliveryCancellationRequest $DualDeliveryCancellationRequest): DualDeliveryCancellationResponse
    {
        return $this->callInternal('dualDeliveryCancellationRequestOperation', [$DualDeliveryCancellationRequest]);
    }
}
