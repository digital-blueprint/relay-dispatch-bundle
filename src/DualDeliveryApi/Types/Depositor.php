<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class Depositor
{
    /**
     * @var InternationalAccount
     */
    protected $InternationalAccount = null;

    /**
     * @var LocalAccount
     */
    protected $LocalAccount = null;

    /**
     * @param InternationalAccount $InternationalAccount
     * @param LocalAccount         $LocalAccount
     */
    public function __construct($InternationalAccount, $LocalAccount)
    {
        $this->InternationalAccount = $InternationalAccount;
        $this->LocalAccount = $LocalAccount;
    }

    public function getInternationalAccount(): InternationalAccount
    {
        return $this->InternationalAccount;
    }

    public function setInternationalAccount(InternationalAccount $InternationalAccount): self
    {
        $this->InternationalAccount = $InternationalAccount;

        return $this;
    }

    public function getLocalAccount(): LocalAccount
    {
        return $this->LocalAccount;
    }

    public function setLocalAccount(LocalAccount $LocalAccount): self
    {
        $this->LocalAccount = $LocalAccount;

        return $this;
    }
}
