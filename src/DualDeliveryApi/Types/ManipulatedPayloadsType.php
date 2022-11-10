<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ManipulatedPayloadsType
{
    /**
     * @var PayloadType[]
     */
    protected $ManipulatedPayload = null;

    /**
     * @param PayloadType[] $ManipulatedPayload
     */
    public function __construct(array $ManipulatedPayload)
    {
        $this->ManipulatedPayload = $ManipulatedPayload;
    }

    /**
     * @return PayloadType[]
     */
    public function getManipulatedPayload(): array
    {
        return $this->ManipulatedPayload;
    }

    /**
     * @param PayloadType[] $ManipulatedPayload
     */
    public function setManipulatedPayload(array $ManipulatedPayload): self
    {
        $this->ManipulatedPayload = $ManipulatedPayload;

        return $this;
    }
}
