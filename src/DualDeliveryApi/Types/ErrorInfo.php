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

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->Code;
    }

    /**
     * @param int $Code
     *
     * @return ErrorInfo
     */
    public function setCode($Code)
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
     *
     * @return ErrorInfo
     */
    public function setText($Text)
    {
        $this->Text = $Text;

        return $this;
    }
}
