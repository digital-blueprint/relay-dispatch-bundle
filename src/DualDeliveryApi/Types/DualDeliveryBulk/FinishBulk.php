<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

class FinishBulk
{
    /**
     * @var ?int
     */
    protected $BulkId = null;

    public function __construct(?int $BulkId)
    {
        $this->BulkId = $BulkId;
    }

    public function getBulkId(): ?int
    {
        return $this->BulkId;
    }

    public function setBulkId(int $BulkId): void
    {
        $this->BulkId = $BulkId;
    }
}
