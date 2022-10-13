<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class UniversalBankTransactionType extends PaymentMethodType
{
    /**
     * @var AccountType
     */
    protected $BeneficiaryAccount = null;

    /**
     * @var PaymentReferenceType
     */
    protected $PaymentReference = null;

    /**
     * @var bool
     */
    protected $ConsolidatorPayable = null;

    /**
     * @param string                     $Comment
     * @param PaymentMethodExtensionType $PaymentMethodExtension
     * @param AccountType                $BeneficiaryAccount
     * @param PaymentReferenceType       $PaymentReference
     * @param bool                       $ConsolidatorPayable
     */
    public function __construct($Comment, $PaymentMethodExtension, $BeneficiaryAccount, $PaymentReference, $ConsolidatorPayable)
    {
        parent::__construct($Comment, $PaymentMethodExtension);
        $this->BeneficiaryAccount = $BeneficiaryAccount;
        $this->PaymentReference = $PaymentReference;
        $this->ConsolidatorPayable = $ConsolidatorPayable;
    }

    /**
     * @return AccountType
     */
    public function getBeneficiaryAccount()
    {
        return $this->BeneficiaryAccount;
    }

    /**
     * @param AccountType $BeneficiaryAccount
     *
     * @return UniversalBankTransactionType
     */
    public function setBeneficiaryAccount($BeneficiaryAccount)
    {
        $this->BeneficiaryAccount = $BeneficiaryAccount;

        return $this;
    }

    /**
     * @return PaymentReferenceType
     */
    public function getPaymentReference()
    {
        return $this->PaymentReference;
    }

    /**
     * @param PaymentReferenceType $PaymentReference
     *
     * @return UniversalBankTransactionType
     */
    public function setPaymentReference($PaymentReference)
    {
        $this->PaymentReference = $PaymentReference;

        return $this;
    }

    /**
     * @return bool
     */
    public function getConsolidatorPayable()
    {
        return $this->ConsolidatorPayable;
    }

    /**
     * @param bool $ConsolidatorPayable
     *
     * @return UniversalBankTransactionType
     */
    public function setConsolidatorPayable($ConsolidatorPayable)
    {
        $this->ConsolidatorPayable = $ConsolidatorPayable;

        return $this;
    }
}
