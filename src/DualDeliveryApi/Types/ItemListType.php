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

    /**
     * @return string
     */
    public function getHeaderDescription()
    {
        return $this->HeaderDescription;
    }

    /**
     * @param string $HeaderDescription
     *
     * @return ItemListType
     */
    public function setHeaderDescription($HeaderDescription)
    {
        $this->HeaderDescription = $HeaderDescription;

        return $this;
    }

    /**
     * @return ListLineItemType
     */
    public function getListLineItem()
    {
        return $this->ListLineItem;
    }

    /**
     * @param ListLineItemType $ListLineItem
     *
     * @return ItemListType
     */
    public function setListLineItem($ListLineItem)
    {
        $this->ListLineItem = $ListLineItem;

        return $this;
    }

    /**
     * @return string
     */
    public function getFooterDescription()
    {
        return $this->FooterDescription;
    }

    /**
     * @param string $FooterDescription
     *
     * @return ItemListType
     */
    public function setFooterDescription($FooterDescription)
    {
        $this->FooterDescription = $FooterDescription;

        return $this;
    }
}
