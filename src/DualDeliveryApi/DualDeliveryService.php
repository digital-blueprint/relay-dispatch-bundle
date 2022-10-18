<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulkRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulkResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryCancellationRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryCancellationResponse;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressingRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressingResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryResponse;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualNotificationBulkRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualNotificationBulkResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualNotificationRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualNotificationRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualNotificationResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\StatusRequestType;

class DualDeliveryService extends \SoapClient
{
    private static $classmap = [
      'PersonDataType' => '\\PersonDataType',
      'TelephoneAddressType' => '\\TelephoneAddressType',
      'TelcomNumberType' => '\\TelcomNumberType',
      'IdentificationType' => '\\IdentificationType',
      'Value' => '\\Value',
      'AbstractPersonType' => '\\AbstractPersonType',
      'PhysicalPersonType' => '\\PhysicalPersonType',
      'PersonNameType' => '\\PersonNameType',
      'FamilyName' => '\\FamilyName',
      'CorporateBodyType' => '\\CorporateBodyType',
      'ForAttentionOf' => '\\ForAttentionOf',
      'AbstractAddressType' => '\\AbstractAddressType',
      'PostalAddressType' => '\\PostalAddressType',
      'DeliveryAddress' => '\\DeliveryAddress',
      'InternetAddressType' => '\\InternetAddressType',
      'GeneralAditionalPrintParameterType' => '\\GeneralAditionalPrintParameterType',
      'SignatureType' => '\\SignatureType',
      'SignatureValueType' => '\\SignatureValueType',
      'SignedInfoType' => '\\SignedInfoType',
      'CanonicalizationMethodType' => '\\CanonicalizationMethodType',
      'SignatureMethodType' => '\\SignatureMethodType',
      'ReferenceType' => '\\ReferenceType',
      'TransformsType' => '\\TransformsType',
      'TransformType' => '\\TransformType',
      'DigestMethodType' => '\\DigestMethodType',
      'KeyInfoType' => '\\KeyInfoType',
      'KeyValueType' => '\\KeyValueType',
      'RetrievalMethodType' => '\\RetrievalMethodType',
      'X509DataType' => '\\X509DataType',
      'X509IssuerSerialType' => '\\X509IssuerSerialType',
      'PGPDataType' => '\\PGPDataType',
      'SPKIDataType' => '\\SPKIDataType',
      'ObjectType' => '\\ObjectType',
      'ManifestType' => '\\ManifestType',
      'SignaturePropertiesType' => '\\SignaturePropertiesType',
      'SignaturePropertyType' => '\\SignaturePropertyType',
      'DSAKeyValueType' => '\\DSAKeyValueType',
      'RSAKeyValueType' => '\\RSAKeyValueType',
      'BillerExtensionType' => '\\BillerExtensionType',
      'DeliveryExtensionType' => '\\DeliveryExtensionType',
      'DetailsExtensionType' => '\\DetailsExtensionType',
      'InvoiceRecipientExtensionType' => '\\InvoiceRecipientExtensionType',
      'InvoiceRootExtensionType' => '\\InvoiceRootExtensionType',
      'ListLineItemExtensionType' => '\\ListLineItemExtensionType',
      'OrderingPartyExtensionType' => '\\OrderingPartyExtensionType',
      'PaymentConditionsExtensionType' => '\\PaymentConditionsExtensionType',
      'PaymentMethodExtensionType' => '\\PaymentMethodExtensionType',
      'PresentationDetailsExtensionType' => '\\PresentationDetailsExtensionType',
      'ReductionAndSurchargeDetailsExtensionType' => '\\ReductionAndSurchargeDetailsExtensionType',
      'TaxExtensionType' => '\\TaxExtensionType',
      'CustomType' => '\\CustomType',
      'AccountType' => '\\AccountType',
      'AdditionalInformationType' => '\\AdditionalInformationType',
      'AddressIdentifierType' => '\\AddressIdentifierType',
      'AddressType' => '\\AddressType',
      'ArticleNumberType' => '\\ArticleNumberType',
      'BankCodeCType' => '\\BankCodeCType',
      'BillerType' => '\\BillerType',
      'ClassificationType' => '\\ClassificationType',
      'CountryType' => '\\CountryType',
      'DeliveryType' => '\\DeliveryType',
      'DetailsType' => '\\DetailsType',
      'DirectDebitType' => '\\DirectDebitType',
      'DiscountType' => '\\DiscountType',
      'FurtherIdentificationType' => '\\FurtherIdentificationType',
      'InvoiceType' => '\\InvoiceType',
      'InvoiceRecipientType' => '\\InvoiceRecipientType',
      'ItemListType' => '\\ItemListType',
      'ItemType' => '\\ItemType',
      'ListLineItemType' => '\\ListLineItemType',
      'NoPaymentType' => '\\NoPaymentType',
      'OrderingPartyType' => '\\OrderingPartyType',
      'OrderReferenceDetailType' => '\\OrderReferenceDetailType',
      'OrderReferenceType' => '\\OrderReferenceType',
      'OtherTaxType' => '\\OtherTaxType',
      'PaymentConditionsType' => '\\PaymentConditionsType',
      'PaymentMethodType' => '\\PaymentMethodType',
      'PaymentReferenceType' => '\\PaymentReferenceType',
      'PeriodType' => '\\PeriodType',
      'PresentationDetailsType' => '\\PresentationDetailsType',
      'ReductionAndSurchargeDetailsType' => '\\ReductionAndSurchargeDetailsType',
      'ReductionAndSurchargeListLineItemDetailsType' => '\\ReductionAndSurchargeListLineItemDetailsType',
      'ReductionAndSurchargeBaseType' => '\\ReductionAndSurchargeBaseType',
      'ReductionAndSurchargeType' => '\\ReductionAndSurchargeType',
      'TaxRateType' => '\\TaxRateType',
      'TaxType' => '\\TaxType',
      'UnitType' => '\\UnitType',
      'UniversalBankTransactionType' => '\\UniversalBankTransactionType',
      'VATType' => '\\VATType',
      'DualDeliveryRequest' => '\\DualDeliveryRequest',
      'DualDeliveryResponse' => '\\DualDeliveryResponse',
      'DualDeliveryRequestType' => '\\DualDeliveryRequestType',
      'Payments' => '\\Payments',
      'Payment' => '\\Payment',
      'ProcessingProfile' => '\\ProcessingProfile',
      'SenderProfile' => '\\SenderProfile',
      'SenderType' => '\\SenderType',
      'SenderData' => '\\SenderData',
      'RecipientType' => '\\RecipientType',
      'DualDeliveryResponseType' => '\\DualDeliveryResponseType',
      'UsedDeliveryChannels' => '\\UsedDeliveryChannels',
      'ManipulatedPayloadsType' => '\\ManipulatedPayloadsType',
      'UsedDeliveryChannelType' => '\\UsedDeliveryChannelType',
      'ErrorsType' => '\\ErrorsType',
      'PayloadType' => '\\PayloadType',
      'DocumentType' => '\\DocumentType',
      'BinaryDocumentType' => '\\BinaryDocumentType',
      'DocumentReferenceType' => '\\DocumentReferenceType',
      'LocalFileReferenceType' => '\\LocalFileReferenceType',
      'IdReferenceType' => '\\IdReferenceType',
      'AdditionalMetaData' => '\\AdditionalMetaData',
      'AdditionalMetaDataSetType' => '\\AdditionalMetaDataSetType',
      'DeliveryChannels' => '\\DeliveryChannels',
      'PayloadAttributesType' => '\\PayloadAttributesType',
      'Checksum' => '\\Checksum',
      'PaymentForm' => '\\PaymentForm',
      'ParameterSet' => '\\ParameterSet',
      'DeliveryChannelSetType' => '\\DeliveryChannelSetType',
      'ElectronicDeliveryType' => '\\ElectronicDeliveryType',
      'CustomNotificationIntervals' => '\\CustomNotificationIntervals',
      'RecipientNotification' => '\\RecipientNotification',
      'PostalDeliveryType' => '\\PostalDeliveryType',
      'PrintedEnvelope' => '\\PrintedEnvelope',
      'EMailDeliveryType' => '\\EMailDeliveryType',
      'OtherDeliveryType' => '\\OtherDeliveryType',
      'AccountInfo' => '\\AccountInfo',
      'Receiver' => '\\Receiver',
      'Depositor' => '\\Depositor',
      'InternationalAccount' => '\\InternationalAccount',
      'LocalAccount' => '\\LocalAccount',
      'ApplicationID' => '\\ApplicationID',
      'PropertyValueMetaDataSetType' => '\\PropertyValueMetaDataSetType',
      'AdditionalPrintParameter' => '\\AdditionalPrintParameter',
      'AdditionalPrintParameterSetType' => '\\AdditionalPrintParameterSetType',
      'PropertyValuePrintParameterSetType' => '\\PropertyValuePrintParameterSetType',
      'ParameterType' => '\\ParameterType',
      'StatusType' => '\\StatusType',
      'ErrorType' => '\\ErrorType',
      'GetVersionRequest' => '\\GetVersionRequest',
      'GetVersionResponse' => '\\GetVersionResponse',
      'StatusRequestType' => '\\StatusRequestType',
      'ExtensionPointType' => '\\ExtensionPointType',
      'ParametersType' => '\\ParametersType',
      'PrintParameter' => '\\PrintParameter',
      'Affix' => '\\Affix',
      'AssertionType' => '\\AssertionType',
      'ConditionsType' => '\\ConditionsType',
      'ConditionAbstractType' => '\\ConditionAbstractType',
      'AudienceRestrictionConditionType' => '\\AudienceRestrictionConditionType',
      'AdviceType' => '\\AdviceType',
      'StatementAbstractType' => '\\StatementAbstractType',
      'SubjectStatementAbstractType' => '\\SubjectStatementAbstractType',
      'SubjectType' => '\\SubjectType',
      'NameIdentifierType' => '\\NameIdentifierType',
      'SubjectConfirmationType' => '\\SubjectConfirmationType',
      'AuthenticationStatementType' => '\\AuthenticationStatementType',
      'SubjectLocalityType' => '\\SubjectLocalityType',
      'AuthorityBindingType' => '\\AuthorityBindingType',
      'AuthorizationDecisionStatementType' => '\\AuthorizationDecisionStatementType',
      'ActionType' => '\\ActionType',
      'EvidenceType' => '\\EvidenceType',
      'AttributeStatementType' => '\\AttributeStatementType',
      'AttributeDesignatorType' => '\\AttributeDesignatorType',
      'AttributeType' => '\\AttributeType',
      'DeliveryRequestType' => '\\DeliveryRequestType',
      'Identification' => '\\Identification',
      'NotificationAddress' => '\\NotificationAddress',
      'WebserviceURL' => '\\WebserviceURL',
      'DocumentReference' => '\\DocumentReference',
      'ReferencesType' => '\\ReferencesType',
      'DeliveryRequestStatus' => '\\DeliveryRequestStatus',
      'DeliveryRequestStatusType' => '\\DeliveryRequestStatusType',
      'Error' => '\\ErrorCustom',
      'ErrorInfo' => '\\ErrorInfo',
      'DeliveryRequestStatusACK' => '\\DeliveryRequestStatusACK',
      'DeliveryRequestStatusACKType' => '\\DeliveryRequestStatusACKType',
      'DeliveryNotification' => '\\DeliveryNotification',
      'DeliveryNotificationType' => '\\DeliveryNotificationType',
      'Success' => '\\Success',
      'NotificationsPerformed' => '\\NotificationsPerformed',
      'BinaryConfirmation' => '\\BinaryConfirmation',
      'AdditionalFormat' => '\\AdditionalFormat',
      'DeliveryNotificationACK' => '\\DeliveryNotificationACK',
      'DeliveryNotificationACKType' => '\\DeliveryNotificationACKType',
      'Sender' => '\\Sender',
      'Organisation' => '\\Organisation',
      'DocumentClass' => '\\DocumentClass',
      'DeliveryAnswerType' => '\\DeliveryAnswerType',
      'DeliveryConfirmationType' => '\\DeliveryConfirmationType',
      'DualNotificationRequest' => '\\DualNotificationRequest',
      'DualNotificationRequestType' => '\\DualNotificationRequestType',
      'Result' => '\\Result',
      'NotificationChannel' => '\\NotificationChannel',
      'NotificationChannelSetType' => '\\NotificationChannelSetType',
      'DualNotificationResponseType' => '\\DualNotificationResponseType',
      'EDeliveryNotificationType' => '\\EDeliveryNotificationType',
      'OtherNotificationType' => '\\OtherNotificationType',
      'PostalNotificationType' => '\\PostalNotificationType',
      'Costs' => '\\Costs',
      'DetailedCosts' => '\\DetailedCosts',
      'DelivererInformation' => '\\DelivererInformation',
      'ScannedData' => '\\ScannedData',
      'BinaryDocument' => '\\BinaryDocument',
      'AdditionalResults' => '\\AdditionalResults',
      'AdditonalResultSetType' => '\\AdditonalResultSetType',
      'PropertyValueAdditonalResultSetType' => '\\PropertyValueAdditonalResultSetType',
      'AdditonalPrintResults' => '\\AdditonalPrintResults',
      'AdditionalPrintResultSetType' => '\\AdditionalPrintResultSetType',
      'PropertyValuePrintResultSetType' => '\\PropertyValuePrintResultSetType',
      'DualNotificationBulkResponseType' => '\\DualNotificationBulkResponseType',
      'DualNotificationResponses' => '\\DualNotificationResponses',
      'DualDeliveryBulkRequestType' => '\\DualDeliveryBulkRequestType',
      'FinishBulk' => '\\FinishBulk',
      'DualDeliveryBulkResponseType' => '\\DualDeliveryBulkResponseType',
      'BulkElements' => '\\BulkElements',
      'DualNotificationBulkRequestType' => '\\DualNotificationBulkRequestType',
      'DualDeliveryPreAddressingRequestType' => '\\DualDeliveryPreAddressingRequestType',
      'Recipients' => '\\Recipients',
      'Recipient' => '\\Recipient',
      'DualDeliveryPreAddressingResponseType' => '\\DualDeliveryPreAddressingResponseType',
      'AddressingResults' => '\\AddressingResults',
      'AddressingResult' => '\\AddressingResult',
      'DualDeliveryCancellationRequest' => '\\DualDeliveryCancellationRequest',
      'DualDeliveryCancellationResponse' => '\\DualDeliveryCancellationResponse',
      'DualDeliveryCancellationRequestType' => '\\DualDeliveryCancellationRequestType',
      'DualDeliveryCancellationResponseType' => '\\DualDeliveryCancellationResponseType',
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
                    'cafile' => __DIR__.DIRECTORY_SEPARATOR.'quirks'.DIRECTORY_SEPARATOR.'vendo-at-chain.pem',
                ],
            ],
        ],
    ];

    private $activeQuirks;
    private $origLocation;

    private static function getQuirksForLocation(string $location)
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

    /**
     * @param array|string|null $cert either a path to a PEM file, or an array with a path and a password
     */
    public function __construct(string $location, $cert = null)
    {
        $options = [];

        foreach (self::$classmap as $key => $value) {
            if (!isset($options['classmap'][$key])) {
                $options['classmap'][$key] = __NAMESPACE__.'\\Types'.$value;
            }
        }

        $this->origLocation = $location;
        $this->activeQuirks = self::getQuirksForLocation($location);

        $wsdl_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'wsdl'.DIRECTORY_SEPARATOR.'DualeZustellung.wsdl';

        $options = array_merge([
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'location' => $location,
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

    private function setLocation(string $name)
    {
        // This sets the location based on the SOAP function call name
        $mapping = $this->activeQuirks['operation_path_mapping'];
        $host = $this->activeQuirks['host'];
        if (array_key_exists($name, $mapping)) {
            $path = $mapping[$name];
            // In case the mapping value is null, assume it's not supported
            if ($path === null) {
                throw new \SoapFault(null, $host." doesn't provide ".$name);
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

    /**
     * @return DualDeliveryResponse
     */
    public function dualDeliveryRequestOperation(DualDeliveryRequest $DualDeliveryRequest)
    {
        return $this->callInternal('dualDeliveryRequestOperation', [$DualDeliveryRequest]);
    }

    /**
     * @return DualNotificationResponseType
     */
    public function dualNotificationRequestOperation(DualNotificationRequest $DualNotificationRequest)
    {
        return $this->callInternal('dualNotificationRequestOperation', [$DualNotificationRequest]);
    }

    /**
     * @return DualNotificationRequestType
     */
    public function dualStatusRequestOperation(StatusRequestType $StatusRequest)
    {
        return $this->callInternal('dualStatusRequestOperation', [$StatusRequest]);
    }

    /**
     * @return DualDeliveryBulkResponseType
     */
    public function dualDeliveryBulkRequestOperation(DualDeliveryBulkRequestType $DualDeliveryBulkRequest)
    {
        return $this->callInternal('dualDeliveryBulkRequestOperation', [$DualDeliveryBulkRequest]);
    }

    /**
     * @return DualNotificationBulkResponseType
     */
    public function dualNotificationBulkRequestOperation(DualNotificationBulkRequestType $DualNotificationBulkRequest)
    {
        return $this->callInternal('dualNotificationBulkRequestOperation', [$DualNotificationBulkRequest]);
    }

    /**
     * @return DualDeliveryPreAddressingResponseType
     */
    public function dualDeliveryPreAddressingRequestOperation(DualDeliveryPreAddressingRequestType $DualDeliveryPreAddressingRequest)
    {
        return $this->callInternal('dualDeliveryPreAddressingRequestOperation', [$DualDeliveryPreAddressingRequest]);
    }

    /**
     * @return DualDeliveryCancellationResponse
     */
    public function dualDeliveryCancellationRequestOperation(DualDeliveryCancellationRequest $DualDeliveryCancellationRequest)
    {
        return $this->callInternal('dualDeliveryCancellationRequestOperation', [$DualDeliveryCancellationRequest]);
    }
}
