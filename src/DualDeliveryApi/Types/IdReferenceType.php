<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class IdReferenceType extends DocumentType
{
    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param string $Id
     */
    public function __construct($Id)
    {
        $this->Id = $Id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param string $Id
     *
     * @return stringReferenceType
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }
}
