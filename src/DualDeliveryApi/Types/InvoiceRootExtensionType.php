<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return InvoiceRootExtensionType
     */
    public function getInvoiceRootExtension()
    {
        return $this->InvoiceRootExtension;
    }

    /**
     * @param InvoiceRootExtensionType $InvoiceRootExtension
     *
     * @return InvoiceRootExtensionType
     */
    public function setInvoiceRootExtension($InvoiceRootExtension)
    {
        $this->InvoiceRootExtension = $InvoiceRootExtension;

        return $this;
    }

    /**
     * @return CustomType
     */
    public function getCustom()
    {
        return $this->Custom;
    }

    /**
     * @param CustomType $Custom
     *
     * @return InvoiceRootExtensionType
     */
    public function setCustom($Custom)
    {
        $this->Custom = $Custom;

        return $this;
    }
}
