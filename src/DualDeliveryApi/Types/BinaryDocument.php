<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class BinaryDocument
{
    /**
     * @var string
     */
    protected $MIMEType = null;

    public function __construct(string $MIMEType)
    {
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
