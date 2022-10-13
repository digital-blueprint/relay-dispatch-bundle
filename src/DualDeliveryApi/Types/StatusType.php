<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class StatusType
{
    /**
     * @var string
     */
    protected $Code = null;

    /**
     * @var string
     */
    protected $Text = null;

    /**
     * @var \DateTime
     */
    protected $Timestamp = null;

    /**
     * @param string $Code
     */
    public function __construct($Code)
    {
        $this->Code = $Code;
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
     * @return StatusType
     */
    public function setCode($Code)
    {
        $this->Code = $Code;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->Text;
    }

    /**
     * @param string $Text
     *
     * @return StatusType
     */
    public function setText($Text)
    {
        $this->Text = $Text;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp()
    {
        if ($this->Timestamp === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->Timestamp);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @param \DateTime $Timestamp
     *
     * @return StatusType
     */
    public function setTimestamp(\DateTime $Timestamp = null)
    {
        if ($Timestamp === null) {
            $this->Timestamp = null;
        } else {
            $this->Timestamp = $Timestamp->format(\DateTime::ATOM);
        }

        return $this;
    }
}
