<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ArticleNumberTypeType
{
    public const __default = 'PZN';
    public const PZN = 'PZN';
    public const GTIN = 'GTIN';
    public const InvoiceRecipientsArticleNumber = 'InvoiceRecipientsArticleNumber';
    public const BillersArticleNumber = 'BillersArticleNumber';
}
