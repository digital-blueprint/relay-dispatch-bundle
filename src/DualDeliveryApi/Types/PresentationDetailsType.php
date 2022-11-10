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

    public function getURL(): AnyURI
    {
        return $this->URL;
    }

    public function setURL(AnyURI $URL): self
    {
        $this->URL = $URL;

        return $this;
    }

    public function getLogoURL(): AnyURI
    {
        return $this->LogoURL;
    }

    public function setLogoURL(AnyURI $LogoURL): self
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
     */
    public function setLayoutID($LayoutID): self
    {
        $this->LayoutID = $LayoutID;

        return $this;
    }

    public function getSuppressZero(): bool
    {
        return $this->SuppressZero;
    }

    public function setSuppressZero(bool $SuppressZero): self
    {
        $this->SuppressZero = $SuppressZero;

        return $this;
    }

    public function getPresentationDetailsExtension(): PresentationDetailsExtensionType
    {
        return $this->PresentationDetailsExtension;
    }

    public function setPresentationDetailsExtension(PresentationDetailsExtensionType $PresentationDetailsExtension): self
    {
        $this->PresentationDetailsExtension = $PresentationDetailsExtension;

        return $this;
    }
}
