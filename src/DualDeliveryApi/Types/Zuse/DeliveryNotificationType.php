<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Success;

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

    public function getSuccess(): Success
    {
        return $this->Success;
    }

    public function setSuccess(Success $Success): self
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

    public function setError(\Error $Error): self
    {
        $this->Error = $Error;

        return $this;
    }

    /**
     * @return AdditionalFormat[]
     */
    public function getAdditionalFormat(): array
    {
        return $this->AdditionalFormat;
    }

    /**
     * @param AdditionalFormat[] $AdditionalFormat
     */
    public function setAdditionalFormat(array $AdditionalFormat = null): self
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
     */
    public function setVersion($version): self
    {
        $this->version = $version;

        return $this;
    }
}
