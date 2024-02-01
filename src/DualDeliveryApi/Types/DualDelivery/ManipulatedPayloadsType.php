<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class ManipulatedPayloadsType
{
    /**
     * @var PayloadType[]
     */
    protected $ManipulatedPayload;

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
    public function setManipulatedPayload(array $ManipulatedPayload): void
    {
        $this->ManipulatedPayload = $ManipulatedPayload;
    }
}
