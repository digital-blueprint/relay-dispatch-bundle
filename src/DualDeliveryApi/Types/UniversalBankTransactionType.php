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

    public function getBeneficiaryAccount(): AccountType
    {
        return $this->BeneficiaryAccount;
    }

    public function setBeneficiaryAccount(AccountType $BeneficiaryAccount): self
    {
        $this->BeneficiaryAccount = $BeneficiaryAccount;

        return $this;
    }

    public function getPaymentReference(): PaymentReferenceType
    {
        return $this->PaymentReference;
    }

    public function setPaymentReference(PaymentReferenceType $PaymentReference): self
    {
        $this->PaymentReference = $PaymentReference;

        return $this;
    }

    public function getConsolidatorPayable(): bool
    {
        return $this->ConsolidatorPayable;
    }

    public function setConsolidatorPayable(bool $ConsolidatorPayable): self
    {
        $this->ConsolidatorPayable = $ConsolidatorPayable;

        return $this;
    }
}
