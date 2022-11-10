<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class OtherTaxType
{
    /**
     * @var string
     */
    protected $Comment = null;

    /**
     * @var Decimal2Type
     */
    protected $Amount = null;

    /**
     * @param string       $Comment
     * @param Decimal2Type $Amount
     */
    public function __construct($Comment, $Amount)
    {
        $this->Comment = $Comment;
        $this->Amount = $Amount;
    }

    public function getComment(): string
    {
        return $this->Comment;
    }

    public function setComment(string $Comment): self
    {
        $this->Comment = $Comment;

        return $this;
    }

    /**
     * @return Decimal2Type
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * @param Decimal2Type $Amount
     */
    public function setAmount($Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }
}
