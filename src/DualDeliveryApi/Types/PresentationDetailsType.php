<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PresentationDetailsType
{
    /**
     * @var AnyURI
     */
    protected $URL = null;

    /**
     * @var AnyURI
     */
    protected $LogoURL = null;

    /**
     * @var AlphaNumIDType
     */
    protected $LayoutID = null;

    /**
     * @var bool
     */
    protected $SuppressZero = null;

    /**
     * @var PresentationDetailsExtensionType
     */
    protected $PresentationDetailsExtension = null;

    /**
     * @param AnyURI                           $URL
     * @param AnyURI                           $LogoURL
     * @param AlphaNumIDType                   $LayoutID
     * @param bool                             $SuppressZero
     * @param PresentationDetailsExtensionType $PresentationDetailsExtension
     */
    public function __construct($URL, $LogoURL, $LayoutID, $SuppressZero, $PresentationDetailsExtension)
    {
        $this->URL = $URL;
        $this->LogoURL = $LogoURL;
        $this->LayoutID = $LayoutID;
        $this->SuppressZero = $SuppressZero;
        $this->PresentationDetailsExtension = $PresentationDetailsExtension;
    }

    /**
     * @return AnyURI
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * @param AnyURI $URL
     *
     * @return PresentationDetailsType
     */
    public function setURL($URL)
    {
        $this->URL = $URL;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getLogoURL()
    {
        return $this->LogoURL;
    }

    /**
     * @param AnyURI $LogoURL
     *
     * @return PresentationDetailsType
     */
    public function setLogoURL($LogoURL)
    {
        $this->LogoURL = $LogoURL;

        return $this;
    }

    /**
     * @return AlphaNumIDType
     */
    public function getLayoutID()
    {
        return $this->LayoutID;
    }

    /**
     * @param AlphaNumIDType $LayoutID
     *
     * @return PresentationDetailsType
     */
    public function setLayoutID($LayoutID)
    {
        $this->LayoutID = $LayoutID;

        return $this;
    }

    /**
     * @return bool
     */
    public function getSuppressZero()
    {
        return $this->SuppressZero;
    }

    /**
     * @param bool $SuppressZero
     *
     * @return PresentationDetailsType
     */
    public function setSuppressZero($SuppressZero)
    {
        $this->SuppressZero = $SuppressZero;

        return $this;
    }

    /**
     * @return PresentationDetailsExtensionType
     */
    public function getPresentationDetailsExtension()
    {
        return $this->PresentationDetailsExtension;
    }

    /**
     * @param PresentationDetailsExtensionType $PresentationDetailsExtension
     *
     * @return PresentationDetailsType
     */
    public function setPresentationDetailsExtension($PresentationDetailsExtension)
    {
        $this->PresentationDetailsExtension = $PresentationDetailsExtension;

        return $this;
    }
}
