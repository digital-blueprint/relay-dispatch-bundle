<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class BinaryDocument
{
    /**
     * @var UNKNOWN
     */
    protected $MIMEType = null;

    /**
     * @param UNKNOWN $MIMEType
     */
    public function __construct($MIMEType)
    {
        $this->MIMEType = $MIMEType;
    }

    /**
     * @return UNKNOWN
     */
    public function getMIMEType()
    {
        return $this->MIMEType;
    }

    /**
     * @param UNKNOWN $MIMEType
     */
    public function setMIMEType($MIMEType): self
    {
        $this->MIMEType = $MIMEType;

        return $this;
    }
}
