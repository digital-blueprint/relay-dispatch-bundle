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

    /**
     * @return Receiver
     */
    public function getReceiver()
    {
        return $this->Receiver;
    }

    /**
     * @param Receiver $Receiver
     *
     * @return AccountInfo
     */
    public function setReceiver($Receiver)
    {
        $this->Receiver = $Receiver;

        return $this;
    }

    /**
     * @return Depositor
     */
    public function getDepositor()
    {
        return $this->Depositor;
    }

    /**
     * @param Depositor $Depositor
     *
     * @return AccountInfo
     */
    public function setDepositor($Depositor)
    {
        $this->Depositor = $Depositor;

        return $this;
    }
}
