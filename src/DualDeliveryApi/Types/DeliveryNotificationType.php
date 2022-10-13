<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DeliveryNotificationType extends DeliveryAnswerType
{
    /**
     * @var Success
     */
    protected $Success = null;

    /**
     * @var Error
     */
    protected $Error = null;

    /**
     * @var AdditionalFormat[]
     */
    protected $AdditionalFormat = null;

    /**
     * @var anonymous290
     */
    protected $version = null;

    /**
     * @param string255    $DeliveryService
     * @param token255     $AppDeliveryID
     * @param string       $GZ
     * @param token255     $MZSDeliveryID
     * @param token255     $ZSDeliveryID
     * @param Success      $Success
     * @param Error        $Error
     * @param anonymous290 $version
     */
    public function __construct($DeliveryService, $AppDeliveryID, $GZ, $MZSDeliveryID, $ZSDeliveryID, $Success, $Error, $version)
    {
        parent::__construct($DeliveryService, $AppDeliveryID, $GZ, $MZSDeliveryID, $ZSDeliveryID);
        $this->Success = $Success;
        $this->Error = $Error;
        $this->version = $version;
    }

    /**
     * @return Success
     */
    public function getSuccess()
    {
        return $this->Success;
    }

    /**
     * @param Success $Success
     *
     * @return DeliveryNotificationType
     */
    public function setSuccess($Success)
    {
        $this->Success = $Success;

        return $this;
    }

    /**
     * @return Error
     */
    public function getError()
    {
        return $this->Error;
    }

    /**
     * @param Error $Error
     *
     * @return DeliveryNotificationType
     */
    public function setError($Error)
    {
        $this->Error = $Error;

        return $this;
    }

    /**
     * @return AdditionalFormat[]
     */
    public function getAdditionalFormat()
    {
        return $this->AdditionalFormat;
    }

    /**
     * @param AdditionalFormat[] $AdditionalFormat
     *
     * @return DeliveryNotificationType
     */
    public function setAdditionalFormat(array $AdditionalFormat = null)
    {
        $this->AdditionalFormat = $AdditionalFormat;

        return $this;
    }

    /**
     * @return anonymous290
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param anonymous290 $version
     *
     * @return DeliveryNotificationType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
