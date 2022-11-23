<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\Receiver;

class AccountInfo
{
    /**
     * @var Receiver
     */
    protected $Receiver = null;

    /**
     * @var ?Depositor
     */
    protected $Depositor = null;

    public function __construct(Receiver $Receiver, ?Depositor $Depositor)
    {
        $this->Receiver = $Receiver;
        $this->Depositor = $Depositor;
    }

    public function getReceiver(): Receiver
    {
        return $this->Receiver;
    }

    public function setReceiver(Receiver $Receiver): void
    {
        $this->Receiver = $Receiver;
    }

    public function getDepositor(): ?Depositor
    {
        return $this->Depositor;
    }

    public function setDepositor(Depositor $Depositor): void
    {
        $this->Depositor = $Depositor;
    }
}
