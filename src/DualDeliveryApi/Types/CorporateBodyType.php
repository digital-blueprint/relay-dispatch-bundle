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

    public function getFullName(): string
    {
        return $this->FullName;
    }

    public function setFullName(string $FullName): self
    {
        $this->FullName = $FullName;

        return $this;
    }

    public function getOrganization(): string
    {
        return $this->Organization;
    }

    public function setOrganization(string $Organization): self
    {
        $this->Organization = $Organization;

        return $this;
    }
}
