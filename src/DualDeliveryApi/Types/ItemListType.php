<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ItemListType
{
    /**
     * @var string
     */
    protected $HeaderDescription = null;

    /**
     * @var ListLineItemType
     */
    protected $ListLineItem = null;

    /**
     * @var string
     */
    protected $FooterDescription = null;

    /**
     * @param string           $HeaderDescription
     * @param ListLineItemType $ListLineItem
     * @param string           $FooterDescription
     */
    public function __construct($HeaderDescription, $ListLineItem, $FooterDescription)
    {
        $this->HeaderDescription = $HeaderDescription;
        $this->ListLineItem = $ListLineItem;
        $this->FooterDescription = $FooterDescription;
    }

    public function getHeaderDescription(): string
    {
        return $this->HeaderDescription;
    }

    public function setHeaderDescription(string $HeaderDescription): self
    {
        $this->HeaderDescription = $HeaderDescription;

        return $this;
    }

    public function getListLineItem(): ListLineItemType
    {
        return $this->ListLineItem;
    }

    public function setListLineItem(ListLineItemType $ListLineItem): self
    {
        $this->ListLineItem = $ListLineItem;

        return $this;
    }

    public function getFooterDescription(): string
    {
        return $this->FooterDescription;
    }

    public function setFooterDescription(string $FooterDescription): self
    {
        $this->FooterDescription = $FooterDescription;

        return $this;
    }
}
