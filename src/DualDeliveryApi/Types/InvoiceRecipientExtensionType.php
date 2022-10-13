<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return InvoiceRecipientExtensionType
     */
    public function getInvoiceRecipientExtension()
    {
        return $this->InvoiceRecipientExtension;
    }

    /**
     * @param InvoiceRecipientExtensionType $InvoiceRecipientExtension
     *
     * @return InvoiceRecipientExtensionType
     */
    public function setInvoiceRecipientExtension($InvoiceRecipientExtension)
    {
        $this->InvoiceRecipientExtension = $InvoiceRecipientExtension;

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
     * @return InvoiceRecipientExtensionType
     */
    public function setCustom($Custom)
    {
        $this->Custom = $Custom;

        return $this;
    }
}
