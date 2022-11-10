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

    public function getHeaderDescription(): string
    {
        return $this->HeaderDescription;
    }

    public function setHeaderDescription(string $HeaderDescription): self
    {
        $this->HeaderDescription = $HeaderDescription;

        return $this;
    }

    public function getItemList(): ItemListType
    {
        return $this->ItemList;
    }

    public function setItemList(ItemListType $ItemList): self
    {
        $this->ItemList = $ItemList;

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
