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

    public function getCode(): string
    {
        return $this->Code;
    }

    public function setCode(string $Code): self
    {
        $this->Code = $Code;

        return $this;
    }

    public function getText(): string
    {
        return $this->Text;
    }

    public function setText(string $Text): self
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
     */
    public function setTimestamp(\DateTime $Timestamp = null): self
    {
        if ($Timestamp === null) {
            $this->Timestamp = null;
        } else {
            $this->Timestamp = $Timestamp->format(\DateTime::ATOM);
        }

        return $this;
    }
}
