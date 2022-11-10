<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AccountInfo
{
    /**
     * @var Receiver
     */
    protected $Receiver = null;

    /**
     * @var Depositor
     */
    protected $Depositor = null;

    /**
     * @param Receiver  $Receiver
     * @param Depositor $Depositor
     */
    public function __construct($Receiver, $Depositor)
    {
        $this->Receiver = $Receiver;
        $this->Depositor = $Depositor;
    }

    public function getReceiver(): Receiver
    {
        return $this->Receiver;
    }

    public function setReceiver(Receiver $Receiver): self
    {
        $this->Receiver = $Receiver;

        return $this;
    }

    public function getDepositor(): Depositor
    {
        return $this->Depositor;
    }

    public function setDepositor(Depositor $Depositor): self
    {
        $this->Depositor = $Depositor;

        return $this;
    }
}
