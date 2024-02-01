<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData;

class CorporateBodyType extends AbstractPersonType
{
    /**
     * @var string
     */
    protected $FullName;

    /**
     * @var ?string
     */
    protected $Organization;

    /**
     * @var ?ForAttentionOf
     */
    protected $ForAttentionOf;

    public function __construct(string $FullName)
    {
        parent::__construct();
        $this->FullName = $FullName;
    }

    public function getFullName(): string
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

    public function getForAttentionOf(): ?ForAttentionOf
    {
        return $this->ForAttentionOf;
    }

    public function setForAttentionOf(ForAttentionOf $ForAttentionOf): void
    {
        $this->ForAttentionOf = $ForAttentionOf;
    }
}
