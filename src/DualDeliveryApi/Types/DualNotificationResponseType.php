<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DualNotificationResponseType
{
    /**
     * @var Success
     */
    protected $Success = null;

    /**
     * @var ErrorType
     */
    protected $Error = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param Success   $Success
     * @param ErrorType $Error
     * @param string    $version
     */
    public function __construct($Success, $Error, $version)
    {
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
     * @return DualNotificationResponseType
     */
    public function setSuccess($Success)
    {
        $this->Success = $Success;

        return $this;
    }

    /**
     * @return ErrorType
     */
    public function getError()
    {
        return $this->Error;
    }

    /**
     * @param ErrorType $Error
     *
     * @return DualNotificationResponseType
     */
    public function setError($Error)
    {
        $this->Error = $Error;

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
     * @return DualNotificationResponseType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
