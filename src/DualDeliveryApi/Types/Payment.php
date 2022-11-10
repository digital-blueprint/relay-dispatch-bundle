<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class Payment
{
    /**
     * @var PaymentForm
     */
    protected $PaymentForm = null;

    /**
     * @var InvoiceType
     */
    protected $Invoice = null;

    /**
     * @var bool
     */
    protected $Printout = null;

    /**
     * @param PaymentForm $PaymentForm
     * @param InvoiceType $Invoice
     * @param bool        $Printout
     */
    public function __construct($PaymentForm, $Invoice, $Printout)
    {
        $this->PaymentForm = $PaymentForm;
        $this->Invoice = $Invoice;
        $this->Printout = $Printout;
    }

    public function getPaymentForm(): PaymentForm
    {
        return $this->PaymentForm;
    }

    public function setPaymentForm(PaymentForm $PaymentForm): self
    {
        $this->PaymentForm = $PaymentForm;

        return $this;
    }

    public function getInvoice(): InvoiceType
    {
        return $this->Invoice;
    }

    public function setInvoice(InvoiceType $Invoice): self
    {
        $this->Invoice = $Invoice;

        return $this;
    }

    public function getPrintout(): bool
    {
        return $this->Printout;
    }

    public function setPrintout(bool $Printout): self
    {
        $this->Printout = $Printout;

        return $this;
    }
}
