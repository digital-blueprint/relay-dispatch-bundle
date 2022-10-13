<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class InternationalAccount
{
    /**
     * @var BIC
     */
    protected $BIC = null;

    /**
     * @var IBAN
     */
    protected $IBAN = null;

    /**
     * @param BIC  $BIC
     * @param IBAN $IBAN
     */
    public function __construct($BIC, $IBAN)
    {
        $this->BIC = $BIC;
        $this->IBAN = $IBAN;
    }

    /**
     * @return BIC
     */
    public function getBIC()
    {
        return $this->BIC;
    }

    /**
     * @param BIC $BIC
     *
     * @return InternationalAccount
     */
    public function setBIC($BIC)
    {
        $this->BIC = $BIC;

        return $this;
    }

    /**
     * @return IBAN
     */
    public function getIBAN()
    {
        return $this->IBAN;
    }

    /**
     * @param IBAN $IBAN
     *
     * @return InternationalAccount
     */
    public function setIBAN($IBAN)
    {
        $this->IBAN = $IBAN;

        return $this;
    }
}
