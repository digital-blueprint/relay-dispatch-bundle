<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class InvoiceRootExtensionType
{
    /**
     * @var InvoiceRootExtensionType
     */
    protected $InvoiceRootExtension;

    /**
     * @var CustomType
     */
    protected $Custom;

    /**
     * @param InvoiceRootExtensionType $InvoiceRootExtension
     * @param CustomType               $Custom
     */
    public function __construct($InvoiceRootExtension, $Custom)
    {
        $this->InvoiceRootExtension = $InvoiceRootExtension;
        $this->Custom = $Custom;
    }

    public function getInvoiceRootExtension(): InvoiceRootExtensionType
    {
        return $this->InvoiceRootExtension;
    }

    public function setInvoiceRootExtension(InvoiceRootExtensionType $InvoiceRootExtension): self
    {
        $this->InvoiceRootExtension = $InvoiceRootExtension;

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
