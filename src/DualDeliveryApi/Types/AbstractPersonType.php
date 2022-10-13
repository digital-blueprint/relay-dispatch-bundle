<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AbstractPersonType
{
    /**
     * @var string
     */
    protected $AbstractSimpleIdentification = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param string $AbstractSimpleIdentification
     * @param string $Id
     */
    public function __construct($AbstractSimpleIdentification, $Id)
    {
        $this->AbstractSimpleIdentification = $AbstractSimpleIdentification;
        $this->Id = $Id;
    }

    /**
     * @return string
     */
    public function getAbstractSimpleIdentification()
    {
        return $this->AbstractSimpleIdentification;
    }

    /**
     * @param string $AbstractSimpleIdentification
     *
     * @return AbstractPersonType
     */
    public function setAbstractSimpleIdentification($AbstractSimpleIdentification)
    {
        $this->AbstractSimpleIdentification = $AbstractSimpleIdentification;

        return $this;
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
     * @return AbstractPersonType
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }
}
