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
use DOMDocument;

class DualDeliveryClient extends \SoapClient
{
    private static $classmap = [
      'PersonDataType' => '\\Zuse\\PersonDataType',
      'TelephoneAddressType' => '\\Zuse\\TelephoneAddressType',
      'TelcomNumberType' => '\\Zuse\\TelcomNumberType',
      'IdentificationType' => '\\Zuse\\IdentificationType',
      'Value' => '\\Zuse\\Value',
      'AbstractPersonType' => '\\Zuse\\AbstractPersonType',
      'PhysicalPersonType' => '\\Zuse\\PhysicalPersonType',
      'PersonNameType' => '\\Zuse\\PersonNameType',
      'CorporateBodyType' => '\\Zuse\\CorporateBodyType',
      'ForAttentionOf' => '\\Zuse\\ForAttentionOf',
      'AbstractAddressType' => '\\Zuse\\AbstractAddressType',
      'PostalAddressType' => '\\Zuse\\PostalAddressType',
      'DeliveryAddress' => '\\Zuse\\DeliveryAddress',
      'InternetAddressType' => '\\Zuse\\InternetAddressType',
      'GeneralAditionalPrintParameterType' => '\\DualDelivery\\GeneralAditionalPrintParameterType',
      'SignatureType' => '\\XMLDsig\\SignatureType',
      'SignatureValueType' => '\\XMLDsig\\SignatureValueType',
      'SignedInfoType' => '\\XMLDsig\\SignedInfoType',
      'CanonicalizationMethodType' => '\\XMLDsig\\CanonicalizationMethodType',
      'SignatureMethodType' => '\\XMLDsig\\SignatureMethodType',
      'ReferenceType' => '\\XMLDsig\\ReferenceType',
      'TransformsType' => '\\XMLDsig\\TransformsType',
      'TransformType' => '\\XMLDsig\\TransformType',
      'DigestMethodType' => '\\XMLDsig\\DigestMethodType',
      'KeyInfoType' => '\\XMLDsig\\KeyInfoType',
      'KeyValueType' => '\\XMLDsig\\KeyValueType',
      'RetrievalMethodType' => '\\XMLDsig\\RetrievalMethodType',
      'X509DataType' => '\\XMLDsig\\X509DataType',
      'X509IssuerSerialType' => '\\XMLDsig\\X509IssuerSerialType',
      'PGPDataType' => '\\XMLDsig\\PGPDataType',
      'SPKIDataType' => '\\XMLDsig\\SPKIDataType',
      'ObjectType' => '\\XMLDsig\\ObjectType',
      'ManifestType' => '\\XMLDsig\\ManifestType',
      'SignaturePropertiesType' => '\\XMLDsig\\SignaturePropertiesType',
      'SignaturePropertyType' => '\\XMLDsig\\SignaturePropertyType',
      'DSAKeyValueType' => '\\XMLDsig\\DSAKeyValueType',
      'RSAKeyValueType' => '\\XMLDsig\\RSAKeyValueType',
      'BillerExtensionType' => '\\EBInterface\\BillerExtensionType',
      'DeliveryExtensionType' => '\\EBInterface\\DeliveryExtensionType',
      'DetailsExtensionType' => '\\EBInterface\\DetailsExtensionType',
      'InvoiceRecipientExtensionType' => '\\EBInterface\\InvoiceRecipientExtensionType',
      'InvoiceRootExtensionType' => '\\EBInterface\\InvoiceRootExtensionType',
      'ListLineItemExtensionType' => '\\EBInterface\\ListLineItemExtensionType',
      'OrderingPartyExtensionType' => '\\EBInterface\\OrderingPartyExtensionType',
      'PaymentConditionsExtensionType' => '\\EBInterface\\PaymentConditionsExtensionType',
      'PaymentMethodExtensionType' => '\\EBInterface\\PaymentMethodExtensionType',
      'PresentationDetailsExtensionType' => '\\EBInterface\\PresentationDetailsExtensionType',
      'ReductionAndSurchargeDetailsExtensionType' => '\\EBInterface\\ReductionAndSurchargeDetailsExtensionType',
      'TaxExtensionType' => '\\EBInterface\\TaxExtensionType',
      'CustomType' => '\\EBInterface\\CustomType',
      'AccountType' => '\\EBInterface\\AccountType',
      'AdditionalInformationType' => '\\EBInterface\\AdditionalInformationType',
      'AddressIdentifierType' => '\\EBInterface\\AddressIdentifierType',
      'AddressType' => '\\EBInterface\\AddressType',
      'ArticleNumberType' => '\\EBInterface\\ArticleNumberType',
      'BankCodeCType' => '\\EBInterface\\BankCodeCType',
      'BillerType' => '\\EBInterface\\BillerType',
      'ClassificationType' => '\\EBInterface\\ClassificationType',
      'CountryType' => '\\EBInterface\\CountryType',
      'DeliveryType' => '\\EBInterface\\DeliveryType',
      'DetailsType' => '\\EBInterface\\DetailsType',
      'DirectDebitType' => '\\EBInterface\\DirectDebitType',
      'DiscountType' => '\\EBInterface\\DiscountType',
      'FurtherIdentificationType' => '\\EBInterface\\FurtherIdentificationType',
      'InvoiceType' => '\\EBInterface\\InvoiceType',
      'InvoiceRecipientType' => '\\EBInterface\\InvoiceRecipientType',
      'ItemListType' => '\\EBInterface\\ItemListType',
      'ItemType' => '\\EBInterface\\ItemType',
      'ListLineItemType' => '\\EBInterface\\ListLineItemType',
      'NoPaymentType' => '\\EBInterface\\NoPaymentType',
      'OrderingPartyType' => '\\EBInterface\\OrderingPartyType',
      'OrderReferenceDetailType' => '\\EBInterface\\OrderReferenceDetailType',
      'OrderReferenceType' => '\\EBInterface\\OrderReferenceType',
      'OtherTaxType' => '\\EBInterface\\OtherTaxType',
      'PaymentConditionsType' => '\\EBInterface\\PaymentConditionsType',
      'PaymentMethodType' => '\\EBInterface\\PaymentMethodType',
      'PaymentReferenceType' => '\\EBInterface\\PaymentReferenceType',
      'PeriodType' => '\\EBInterface\\PeriodType',
      'PresentationDetailsType' => '\\EBInterface\\PresentationDetailsType',
      'ReductionAndSurchargeDetailsType' => '\\EBInterface\\ReductionAndSurchargeDetailsType',
      'ReductionAndSurchargeListLineItemDetailsType' => '\\EBInterface\\ReductionAndSurchargeListLineItemDetailsType',
      'ReductionAndSurchargeBaseType' => '\\EBInterface\\ReductionAndSurchargeBaseType',
      'ReductionAndSurchargeType' => '\\EBInterface\\ReductionAndSurchargeType',
      'TaxRateType' => '\\EBInterface\\TaxRateType',
      'TaxType' => '\\EBInterface\\TaxType',
      'UnitType' => '\\EBInterface\\UnitType',
      'UniversalBankTransactionType' => '\\EBInterface\\UniversalBankTransactionType',
      'VATType' => '\\EBInterface\\VATType',
      'DualDeliveryRequest' => '\\DualDelivery\\DualDeliveryRequest',
      'DualDeliveryResponse' => '\\DualDelivery\\DualDeliveryResponse',
      'DualDeliveryRequestType' => '\\DualDelivery\\DualDeliveryRequestType',
      'Payments' => '\\DualDelivery\\Payments',
      'Payment' => '\\DualDelivery\\Payment',
      'ProcessingProfile' => '\\DualDelivery\\ProcessingProfile',
      'SenderProfile' => '\\DualDelivery\\SenderProfile',
      'SenderType' => '\\DualDelivery\\SenderType',
      'SenderData' => '\\DualDelivery\\SenderData',
      'RecipientType' => '\\DualDelivery\\RecipientType',
      'DualDeliveryResponseType' => '\\DualDelivery\\DualDeliveryResponseType',
      'UsedDeliveryChannels' => '\\DualDelivery\\UsedDeliveryChannels',
      'ManipulatedPayloadsType' => '\\DualDelivery\\ManipulatedPayloadsType',
      'UsedDeliveryChannelType' => '\\DualDelivery\\UsedDeliveryChannelType',
      'ErrorsType' => '\\DualDelivery\\ErrorsType',
      'PayloadType' => '\\DualDelivery\\PayloadType',
      'DocumentType' => '\\DualDelivery\\DocumentType',
      'BinaryDocumentType' => '\\DualDelivery\\BinaryDocumentType',
      'DocumentReferenceType' => '\\DualDelivery\\DocumentReferenceType',
      'LocalFileReferenceType' => '\\DualDelivery\\LocalFileReferenceType',
      'IdReferenceType' => '\\DualDelivery\\IdReferenceType',
      'AdditionalMetaData' => '\\DualDelivery\\AdditionalMetaData',
      'AdditionalMetaDataSetType' => '\\DualDelivery\\AdditionalMetaDataSetType',
      'DeliveryChannels' => '\\DualDelivery\\DeliveryChannels',
      'PayloadAttributesType' => '\\DualDelivery\\PayloadAttributesType',
      'Checksum' => '\\DualDelivery\\Checksum',
      'PaymentForm' => '\\DualDelivery\\PaymentForm',
      'ParameterSet' => '\\DualDelivery\\ParameterSet',
      'DeliveryChannelSetType' => '\\DualDelivery\\DeliveryChannelSetType',
      'ElectronicDeliveryType' => '\\DualDelivery\\ElectronicDeliveryType',
      'CustomNotificationIntervals' => '\\DualDelivery\\CustomNotificationIntervals',
      'RecipientNotification' => '\\DualDelivery\\RecipientNotification',
      'PostalDeliveryType' => '\\DualDelivery\\PostalDeliveryType',
      'PrintedEnvelope' => '\\DualDelivery\\PrintedEnvelope',
      'EMailDeliveryType' => '\\DualDelivery\\EMailDeliveryType',
      'OtherDeliveryType' => '\\DualDelivery\\OtherDeliveryType',
      'AccountInfo' => '\\DualDelivery\\AccountInfo',
      'Receiver' => '\\Zuse\\Receiver',
      'Depositor' => '\\DualDelivery\\Depositor',
      'InternationalAccount' => '\\DualDelivery\\InternationalAccount',
      'LocalAccount' => '\\DualDelivery\\LocalAccount',
      'ApplicationID' => '\\DualDelivery\\ApplicationID',
      'PropertyValueMetaDataSetType' => '\\DualDelivery\\PropertyValueMetaDataSetType',
      'AdditionalPrintParameter' => '\\DualDelivery\\AdditionalPrintParameter',
      'AdditionalPrintParameterSetType' => '\\DualDelivery\\AdditionalPrintParameterSetType',
      'PropertyValuePrintParameterSetType' => '\\DualDelivery\\PropertyValuePrintParameterSetType',
      'ParameterType' => '\\DualDelivery\\ParameterType',
      'StatusType' => '\\DualDelivery\\StatusType',
      'ErrorType' => '\\DualDelivery\\ErrorType',
      'GetVersionRequest' => '\\DualDelivery\\GetVersionRequest',
      'GetVersionResponse' => '\\DualDelivery\\GetVersionResponse',
      'StatusRequestType' => '\\DualDeliveryNotification\\StatusRequestType',
      'ExtensionPointType' => '\\DualDelivery\\ExtensionPointType',
      'ParametersType' => '\\DualDelivery\\ParametersType',
      'PrintParameter' => '\\Zuse\\PrintParameter',
      'Affix' => '\\Zuse\\Affix',
      'AssertionType' => '\\SAML\\AssertionType',
      'ConditionsType' => '\\SAML\\ConditionsType',
      'ConditionAbstractType' => '\\SAML\\ConditionAbstractType',
      'AudienceRestrictionConditionType' => '\\SAML\\AudienceRestrictionConditionType',
      'AdviceType' => '\\SAML\\AdviceType',
      'StatementAbstractType' => '\\SAML\\StatementAbstractType',
      'SubjectStatementAbstractType' => '\\SAML\\SubjectStatementAbstractType',
      'SubjectType' => '\\SAML\\SubjectType',
      'NameIdentifierType' => '\\SAML\\NameIdentifierType',
      'SubjectConfirmationType' => '\\SAML\\SubjectConfirmationType',
      'AuthenticationStatementType' => '\\SAML\\AuthenticationStatementType',
      'SubjectLocalityType' => '\\SAML\\SubjectLocalityType',
      'AuthorityBindingType' => '\\SAML\\AuthorityBindingType',
      'AuthorizationDecisionStatementType' => '\\SAML\\AuthorizationDecisionStatementType',
      'ActionType' => '\\SAML\\ActionType',
      'EvidenceType' => '\\SAML\\EvidenceType',
      'AttributeStatementType' => '\\SAML\\AttributeStatementType',
      'AttributeDesignatorType' => '\\SAML\\AttributeDesignatorType',
      'AttributeType' => '\\SAML\\AttributeType',
      'DeliveryRequestType' => '\\Zuse\\DeliveryRequestType',
      'Identification' => '\\Zuse\\Identification',
      'NotificationAddress' => '\\Zuse\\NotificationAddress',
      'WebserviceURL' => '\\Zuse\\WebserviceURL',
      'DocumentReference' => '\\Zuse\\DocumentReference',
      'ReferencesType' => '\\Zuse\\ReferencesType',
      'DeliveryRequestStatus' => '\\Zuse\\DeliveryRequestStatus',
      'DeliveryRequestStatusType' => '\\Zuse\\DeliveryRequestStatusType',
      'Error' => '\\Zuse\\Error',
      'ErrorInfo' => '\\Zuse\\ErrorInfo',
      'DeliveryRequestStatusACK' => '\\Zuse\\DeliveryRequestStatusACK',
      'DeliveryRequestStatusACKType' => '\\Zuse\\DeliveryRequestStatusACKType',
      'DeliveryNotification' => '\\Zuse\\DeliveryNotification',
      'DeliveryNotificationType' => '\\Zuse\\DeliveryNotificationType',
      'Success' => '\\Zuse\\Success',
      'NotificationsPerformed' => '\\Zuse\\NotificationsPerformed',
      'BinaryConfirmation' => '\\Zuse\\BinaryConfirmation',
      'AdditionalFormat' => '\\Zuse\\AdditionalFormat',
      'DeliveryNotificationACK' => '\\Zuse\\DeliveryNotificationACK',
      'DeliveryNotificationACKType' => '\\Zuse\\DeliveryNotificationACKType',
      'Sender' => '\\DualDeliveryBulk\\Sender',
      'Organisation' => '\\Zuse\\Organisation',
      'DocumentClass' => '\\Zuse\\DocumentClass',
      'DeliveryAnswerType' => '\\Zuse\\DeliveryAnswerType',
      'DeliveryConfirmationType' => '\\Zuse\\DeliveryConfirmationType',
      'DualNotificationRequest' => '\\DualDeliveryNotification\\DualNotificationRequest',
      'DualNotificationRequestType' => '\\DualDeliveryNotification\\DualNotificationRequestType',
      'Result' => '\\DualDeliveryNotification\\Result',
      'NotificationChannel' => '\\DualDeliveryNotification\\NotificationChannel',
      'NotificationChannelSetType' => '\\DualDeliveryNotification\\NotificationChannelSetType',
      'DualNotificationResponseType' => '\\DualDeliveryNotification\\DualNotificationResponseType',
      'EDeliveryNotificationType' => '\\DualDeliveryNotification\\EDeliveryNotificationType',
      'OtherNotificationType' => '\\DualDeliveryNotification\\OtherNotificationType',
      'PostalNotificationType' => '\\DualDeliveryNotification\\PostalNotificationType',
      'Costs' => '\\DualDeliveryNotification\\Costs',
      'DetailedCosts' => '\\DualDeliveryNotification\\DetailedCosts',
      'DelivererInformation' => '\\DualDeliveryNotification\\DelivererInformation',
      'ScannedData' => '\\DualDeliveryNotification\\ScannedData',
      'BinaryDocument' => '\\DualDeliveryNotification\\BinaryDocument',
      'AdditionalResults' => '\\DualDeliveryNotification\\AdditionalResults',
      'AdditonalResultSetType' => '\\DualDeliveryNotification\\AdditonalResultSetType',
      'PropertyValueAdditonalResultSetType' => '\\DualDeliveryNotification\\PropertyValueAdditonalResultSetType',
      'AdditonalPrintResults' => '\\DualDeliveryNotification\\AdditonalPrintResults',
      'AdditionalPrintResultSetType' => '\\DualDeliveryNotification\\AdditionalPrintResultSetType',
      'PropertyValuePrintResultSetType' => '\\DualDeliveryNotification\\PropertyValuePrintResultSetType',
      'DualNotificationBulkResponseType' => '\\DualDeliveryBulk\\DualNotificationBulkResponseType',
      'DualNotificationResponses' => '\\DualDeliveryBulk\\DualNotificationResponses',
      'DualDeliveryBulkRequestType' => '\\DualDeliveryBulk\\DualDeliveryBulkRequestType',
      'FinishBulk' => '\\DualDeliveryBulk\\FinishBulk',
      'DualDeliveryBulkResponseType' => '\\DualDeliveryBulk\\DualDeliveryBulkResponseType',
      'BulkElements' => '\\DualDeliveryBulk\\BulkElements',
      'DualNotificationBulkRequestType' => '\\DualDeliveryBulk\\DualNotificationBulkRequestType',
      'DualDeliveryPreAddressingRequestType' => '\\DualDeliveryPreAddressing\\DualDeliveryPreAddressingRequestType',
      'Recipients' => '\\DualDeliveryPreAddressing\\Recipients',
      'Recipient' => '\\DualDeliveryPreAddressing\\Recipient',
      'DualDeliveryPreAddressingResponseType' => '\\DualDeliveryPreAddressing\\DualDeliveryPreAddressingResponseType',
      'AddressingResults' => '\\DualDeliveryPreAddressing\\AddressingResults',
      'AddressingResult' => '\\DualDeliveryPreAddressing\\AddressingResult',
      'DualDeliveryCancellationRequest' => '\\DualDeliveryCancellation\\DualDeliveryCancellationRequest',
      'DualDeliveryCancellationResponse' => '\\DualDeliveryCancellation\\DualDeliveryCancellationResponse',
      'DualDeliveryCancellationRequestType' => '\\DualDeliveryCancellation\\DualDeliveryCancellationRequestType',
      'DualDeliveryCancellationResponseType' => '\\DualDeliveryCancellation\\DualDeliveryCancellationResponseType',
    ];

    // Some vendors have special requirements that are not part of the spec, instead of makeing everything
    // configurable we just note a list of quirks here and apply them based on the domain of the SOAP endpoint
    private const QUIRKS = [
        [
            'domains' => ['dual.vendo.at', 'dualtest.vendo.at'],
            'operation_path_mapping' => [
                'dualStatusRequestOperation' => '/mprs-polling/services10/DDPollingServiceProcessor',
                'dualDeliveryCancellationRequestOperation' => '/mprs-polling/services10/DDPollingServiceProcessor',
                'dualNotificationRequestOperation' => '/mprs-polling/services10/DDPollingServiceProcessor',
                'dualDeliveryRequestOperation' => '/mprs-core/services10/DDWebServiceProcessor',
                'dualDeliveryPreAddressingRequestOperation' => '/mprs-core/services10/DDAddressingProcessor',
                // Looks like the bulk APIs aren't supported
                'dualNotificationBulkRequestOperation' => null,
                'dualDeliveryBulkRequestOperation' => null,
            ],
            'stream_context_options' => [
                'ssl' => [
                    // vendo gives errors sometimes if 1.3 is used, they recommended restricting to 1.2
                    'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
                    // Their server config is broken and not sending back the whole cert chain
                    'cafile' => __DIR__.DIRECTORY_SEPARATOR.'Vendo'.DIRECTORY_SEPARATOR.'vendo-at-chain.pem',
                    // SSL cert is expired
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ],
        ],
    ];

    private $activeQuirks;
    private $origLocation;

    private static function getQuirksForLocation(string $location): array
    {
        $host = parse_url($location, PHP_URL_HOST);
        if ($host === false) {
            throw new \RuntimeException();
        }
        foreach (self::QUIRKS as $quirk) {
            if (in_array($host, $quirk['domains'], true)) {
                $quirk['host'] = $host;

                return $quirk;
            }
        }
        // default no quirks
        return [
            'host' => $host,
            'domains' => [],
            'operation_path_mapping' => [],
            'stream_context_options' => [],
        ];
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
        foreach (self::$classmap as $key => $value) {
            $classmap[$key] = __NAMESPACE__.'\\Types'.$value;
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
        $this->activeQuirks = self::getQuirksForLocation($location);

        $wsdl_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'wsdl'.DIRECTORY_SEPARATOR.'DualeZustellung.wsdl';

        $options = array_merge([
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'location' => $location,
            'trace' => $trace,
            'stream_context' => stream_context_create($this->activeQuirks['stream_context_options']),
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

    private function setLocation(string $name): void
    {
        // This sets the location based on the SOAP function call name
        $mapping = $this->activeQuirks['operation_path_mapping'];
        $host = $this->activeQuirks['host'];
        if (array_key_exists($name, $mapping)) {
            $path = $mapping[$name];
            // In case the mapping value is null, assume it's not supported
            if ($path === null) {
                throw new \SoapFault('', $host." doesn't provide ".$name);
            }
        } else {
            $path = '';
        }
        $newLocation = rtrim($this->origLocation, '/').$path;
        $this->__setLocation($newLocation);
    }

    /*
     * @return mixed
     */
    private function callInternal(string $name, array $args)
    {
        $this->setLocation($name);

        return $this->__soapCall($name, $args);
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
