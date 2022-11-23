<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface\CustomType;

class InvoiceRecipientExtensionType
{
    /**
     * @var InvoiceRecipientExtensionType
     */
    protected $InvoiceRecipientExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param InvoiceRecipientExtensionType $InvoiceRecipientExtension
     * @param CustomType                    $Custom
     */
    public function __construct($InvoiceRecipientExtension, $Custom)
    {
        $this->InvoiceRecipientExtension = $InvoiceRecipientExtension;
        $this->Custom = $Custom;
    }

    public function getInvoiceRecipientExtension(): InvoiceRecipientExtensionType
    {
        return $this->InvoiceRecipientExtension;
    }

    public function setInvoiceRecipientExtension(InvoiceRecipientExtensionType $InvoiceRecipientExtension): self
    {
        $this->InvoiceRecipientExtension = $InvoiceRecipientExtension;

        return $this;
    }

    public function getCustom(): CustomType
    {
        return $this->Custom;
    }

    public function setCustom(CustomType $Custom): self
    {
        $this->Custom = $Custom;

        return $this;
    }
}
