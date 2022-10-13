<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ErrorType
{
    /**
     * @var string
     */
    protected $Info = null;

    /**
     * @var string
     */
    protected $Code = null;

    /**
     * @var string
     */
    protected $Severity = null;

    /**
     * @param string $Info
     * @param string $Code
     */
    public function __construct($Info, $Code)
    {
        $this->Info = $Info;
        $this->Code = $Code;
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->Info;
    }

    /**
     * @param string $Info
     *
     * @return ErrorType
     */
    public function setInfo($Info)
    {
        $this->Info = $Info;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->Code;
    }

    /**
     * @param string $Code
     *
     * @return ErrorType
     */
    public function setCode($Code)
    {
        $this->Code = $Code;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeverity()
    {
        return $this->Severity;
    }

    /**
     * @param string $Severity
     *
     * @return ErrorType
     */
    public function setSeverity($Severity)
    {
        $this->Severity = $Severity;

        return $this;
    }
}
