<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface\InvoiceType;

class Payment
{
    /**
     * @var ?PaymentForm
     */
    protected $PaymentForm;

    /**
     * @var ?InvoiceType
     */
    protected $Invoice;

    /**
     * @var bool
     */
    protected $Printout;

    public function __construct(?PaymentForm $PaymentForm, ?InvoiceType $Invoice, bool $Printout)
    {
        $this->PaymentForm = $PaymentForm;
        $this->Invoice = $Invoice;
        $this->Printout = $Printout;
    }

    public function getPaymentForm(): ?PaymentForm
    {
        return $this->PaymentForm;
    }

    public function setPaymentForm(PaymentForm $PaymentForm): void
    {
        $this->PaymentForm = $PaymentForm;
    }

    public function getInvoice(): ?InvoiceType
    {
        return $this->Invoice;
    }

    public function setInvoice(InvoiceType $Invoice): void
    {
        $this->Invoice = $Invoice;
    }

    public function getPrintout(): bool
    {
        return $this->Printout;
    }

    public function setPrintout(bool $Printout): void
    {
        $this->Printout = $Printout;
    }
}
