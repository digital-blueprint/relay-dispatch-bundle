<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ManifestType
{
    /**
     * @var ReferenceType
     */
    protected $Reference = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param ReferenceType $Reference
     * @param string        $Id
     */
    public function __construct($Reference, $Id)
    {
        $this->Reference = $Reference;
        $this->Id = $Id;
    }

    /**
     * @return ReferenceType
     */
    public function getReference()
    {
        return $this->Reference;
    }

    /**
     * @param ReferenceType $Reference
     *
     * @return ManifestType
     */
    public function setReference($Reference)
    {
        $this->Reference = $Reference;

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
     * @return ManifestType
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }
}
