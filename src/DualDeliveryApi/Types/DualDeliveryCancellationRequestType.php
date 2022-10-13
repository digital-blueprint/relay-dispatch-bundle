<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DualDeliveryCancellationRequestType
{
    /**
     * @var SenderProfile
     */
    protected $SenderProfile = null;

    /**
     * @var ApplicationID
     */
    protected $ApplicationID = null;

    /**
     * @var string
     */
    protected $DualDeliveryID = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param SenderProfile $SenderProfile
     * @param ApplicationID $ApplicationID
     * @param string        $DualDeliveryID
     * @param string        $version
     */
    public function __construct($SenderProfile, $ApplicationID, $DualDeliveryID, $version)
    {
        $this->SenderProfile = $SenderProfile;
        $this->ApplicationID = $ApplicationID;
        $this->DualDeliveryID = $DualDeliveryID;
        $this->version = $version;
    }

    /**
     * @return SenderProfile
     */
    public function getSenderProfile()
    {
        return $this->SenderProfile;
    }

    /**
     * @param SenderProfile $SenderProfile
     *
     * @return DualDeliveryCancellationRequestType
     */
    public function setSenderProfile($SenderProfile)
    {
        $this->SenderProfile = $SenderProfile;

        return $this;
    }

    /**
     * @return ApplicationID
     */
    public function getApplicationID()
    {
        return $this->ApplicationID;
    }

    /**
     * @param ApplicationID $ApplicationID
     *
     * @return DualDeliveryCancellationRequestType
     */
    public function setApplicationID($ApplicationID)
    {
        $this->ApplicationID = $ApplicationID;

        return $this;
    }

    /**
     * @return string
     */
    public function getDualDeliveryID()
    {
        return $this->DualDeliveryID;
    }

    /**
     * @param string $DualDeliveryID
     *
     * @return DualDeliveryCancellationRequestType
     */
    public function setDualDeliveryID($DualDeliveryID)
    {
        $this->DualDeliveryID = $DualDeliveryID;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return DualDeliveryCancellationRequestType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
