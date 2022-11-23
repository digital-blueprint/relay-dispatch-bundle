<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryCancellation;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ApplicationID;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderProfile;

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
     * @return DualDeliveryCancellationRequestType
     */
    public function setSenderProfile(SenderProfile $SenderProfile)
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
     * @return DualDeliveryCancellationRequestType
     */
    public function setApplicationID(ApplicationID $ApplicationID)
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
     * @return DualDeliveryCancellationRequestType
     */
    public function setDualDeliveryID(string $DualDeliveryID)
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
     * @return DualDeliveryCancellationRequestType
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }
}
