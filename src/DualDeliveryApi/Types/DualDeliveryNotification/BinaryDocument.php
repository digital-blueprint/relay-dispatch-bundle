<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\BinaryDocumentType;

class BinaryDocument extends BinaryDocumentType
{
    /**
     * @var string
     */
    protected $MIMEType = null;

    public function __construct(string $Content, string $MIMEType)
    {
        parent::__construct($Content);
        $this->MIMEType = $MIMEType;
    }

    public function getMIMEType(): string
    {
        return $this->MIMEType;
    }

    public function setMIMEType(string $MIMEType): void
    {
        $this->MIMEType = $MIMEType;
    }
}
