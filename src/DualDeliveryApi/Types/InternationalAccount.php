<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class InternationalAccount
{
    /**
     * @var string
     */
    protected $BIC = null;

    /**
     * @var string
     */
    protected $IBAN = null;

    public function __construct(string $BIC, string $IBAN)
    {
        $this->BIC = $BIC;
        $this->IBAN = $IBAN;
    }

    public function getBIC(): string
    {
        return $this->BIC;
    }

    public function setBIC(string $BIC): void
    {
        $this->BIC = $BIC;
    }

    public function getIBAN(): string
    {
        return $this->IBAN;
    }

    public function setIBAN(string $IBAN): void
    {
        $this->IBAN = $IBAN;
    }
}
