<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class Depositor
{
    /**
     * @var ?InternationalAccount
     */
    protected $InternationalAccount;

    /**
     * @var ?LocalAccount
     */
    protected $LocalAccount;

    public function __construct(?InternationalAccount $InternationalAccount, ?LocalAccount $LocalAccount)
    {
        $this->InternationalAccount = $InternationalAccount;
        $this->LocalAccount = $LocalAccount;
    }

    public function getInternationalAccount(): ?InternationalAccount
    {
        return $this->InternationalAccount;
    }

    public function setInternationalAccount(InternationalAccount $InternationalAccount): void
    {
        $this->InternationalAccount = $InternationalAccount;
    }

    public function getLocalAccount(): ?LocalAccount
    {
        return $this->LocalAccount;
    }

    public function setLocalAccount(LocalAccount $LocalAccount): void
    {
        $this->LocalAccount = $LocalAccount;
    }
}
