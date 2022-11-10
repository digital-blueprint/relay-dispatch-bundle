<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ErrorInfo
{
    /**
     * @var int
     */
    protected $Code = null;

    /**
     * @var string255
     */
    protected $Text = null;

    /**
     * @param int       $Code
     * @param string255 $Text
     */
    public function __construct($Code, $Text)
    {
        $this->Code = $Code;
        $this->Text = $Text;
    }

    public function getCode(): int
    {
        return $this->Code;
    }

    public function setCode(int $Code): self
    {
        $this->Code = $Code;

        return $this;
    }

    /**
     * @return string255
     */
    public function getText()
    {
        return $this->Text;
    }

    /**
     * @param string255 $Text
     */
    public function setText($Text): self
    {
        $this->Text = $Text;

        return $this;
    }
}
