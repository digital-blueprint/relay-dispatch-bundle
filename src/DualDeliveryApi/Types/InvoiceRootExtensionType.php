<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface\CustomType;

class InvoiceRootExtensionType
{
    /**
     * @var InvoiceRootExtensionType
     */
    protected $InvoiceRootExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

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
