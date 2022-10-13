<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DetailsType
{
    /**
     * @var string
     */
    protected $HeaderDescription = null;

    /**
     * @var ItemListType
     */
    protected $ItemList = null;

    /**
     * @var string
     */
    protected $FooterDescription = null;

    /**
     * @param string       $HeaderDescription
     * @param ItemListType $ItemList
     * @param string       $FooterDescription
     */
    public function __construct($HeaderDescription, $ItemList, $FooterDescription)
    {
        $this->HeaderDescription = $HeaderDescription;
        $this->ItemList = $ItemList;
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
     * @return DetailsType
     */
    public function setHeaderDescription($HeaderDescription)
    {
        $this->HeaderDescription = $HeaderDescription;

        return $this;
    }

    /**
     * @return ItemListType
     */
    public function getItemList()
    {
        return $this->ItemList;
    }

    /**
     * @param ItemListType $ItemList
     *
     * @return DetailsType
     */
    public function setItemList($ItemList)
    {
        $this->ItemList = $ItemList;

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
     * @return DetailsType
     */
    public function setFooterDescription($FooterDescription)
    {
        $this->FooterDescription = $FooterDescription;

        return $this;
    }
}
