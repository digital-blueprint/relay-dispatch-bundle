<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class CorporateBodyType extends AbstractPersonType
{
    /**
     * @var ?string
     */
    protected $FullName = null;

    /**
     * @var ?string
     */
    protected $Organization = null;

    public function __construct(string $AbstractSimpleIdentification, string $Id, ?string $FullName)
    {
        parent::__construct($AbstractSimpleIdentification, $Id);
        $this->FullName = $FullName;
    }

    public function getFullName(): ?string
    {
        return $this->FullName;
    }

    public function setFullName(string $FullName): void
    {
        $this->FullName = $FullName;
    }

    public function getOrganization(): ?string
    {
        return $this->Organization;
    }

    public function setOrganization(string $Organization): void
    {
        $this->Organization = $Organization;
    }
}
