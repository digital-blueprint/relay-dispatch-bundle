<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class Recipients
{
    /**
     * @var Recipient
     */
    protected $Recipient = null;

    /**
     * @param Recipient $Recipient
     */
    public function __construct($Recipient)
    {
        $this->Recipient = $Recipient;
    }

    /**
     * @return Recipient
     */
    public function getRecipient()
    {
        return $this->Recipient;
    }

    /**
     * @param Recipient $Recipient
     *
     * @return Recipients
     */
    public function setRecipient($Recipient)
    {
        $this->Recipient = $Recipient;

        return $this;
    }
}
