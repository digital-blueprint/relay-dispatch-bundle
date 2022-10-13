<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class CorporateBodyType extends AbstractPersonType
{
    /**
     * @var string
     */
    protected $FullName = null;

    /**
     * @var string
     */
    protected $Organization = null;

    /**
     * @param string $AbstractSimpleIdentification
     * @param string $Id
     * @param string $FullName
     */
    public function __construct($AbstractSimpleIdentification, $Id, $FullName)
    {
        parent::__construct($AbstractSimpleIdentification, $Id);
        $this->FullName = $FullName;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->FullName;
    }

    /**
     * @param string $FullName
     *
     * @return CorporateBodyType
     */
    public function setFullName($FullName)
    {
        $this->FullName = $FullName;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrganization()
    {
        return $this->Organization;
    }

    /**
     * @param string $Organization
     *
     * @return CorporateBodyType
     */
    public function setOrganization($Organization)
    {
        $this->Organization = $Organization;

        return $this;
    }
}
