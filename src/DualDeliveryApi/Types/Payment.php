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

    /**
     * @return PaymentForm
     */
    public function getPaymentForm()
    {
        return $this->PaymentForm;
    }

    /**
     * @param PaymentForm $PaymentForm
     *
     * @return Payment
     */
    public function setPaymentForm($PaymentForm)
    {
        $this->PaymentForm = $PaymentForm;

        return $this;
    }

    /**
     * @return InvoiceType
     */
    public function getInvoice()
    {
        return $this->Invoice;
    }

    /**
     * @param InvoiceType $Invoice
     *
     * @return Payment
     */
    public function setInvoice($Invoice)
    {
        $this->Invoice = $Invoice;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPrintout()
    {
        return $this->Printout;
    }

    /**
     * @param bool $Printout
     *
     * @return Payment
     */
    public function setPrintout($Printout)
    {
        $this->Printout = $Printout;

        return $this;
    }
}
