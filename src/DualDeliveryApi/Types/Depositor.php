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

    /**
     * @return InternationalAccount
     */
    public function getInternationalAccount()
    {
        return $this->InternationalAccount;
    }

    /**
     * @param InternationalAccount $InternationalAccount
     *
     * @return Depositor
     */
    public function setInternationalAccount($InternationalAccount)
    {
        $this->InternationalAccount = $InternationalAccount;

        return $this;
    }

    /**
     * @return LocalAccount
     */
    public function getLocalAccount()
    {
        return $this->LocalAccount;
    }

    /**
     * @param LocalAccount $LocalAccount
     *
     * @return Depositor
     */
    public function setLocalAccount($LocalAccount)
    {
        $this->LocalAccount = $LocalAccount;

        return $this;
    }
}
