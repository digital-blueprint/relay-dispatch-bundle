<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DocumentTypeType
{
    public const __default = 'Invoice';
    public const Invoice = 'Invoice';
    public const InvoiceForAdvancePayment = 'InvoiceForAdvancePayment';
    public const InvoiceForPartialDelivery = 'InvoiceForPartialDelivery';
    public const FinalSettlement = 'FinalSettlement';
    public const SubsequentCredit = 'SubsequentCredit';
    public const CreditMemo = 'CreditMemo';
    public const SubsequentDebit = 'SubsequentDebit';
    public const SelfBilling = 'SelfBilling';
}
