<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

class FinishBulk
{
    /**
     * @var int
     */
    protected $BulkId = null;

    /**
     * @param int $BulkId
     */
    public function __construct($BulkId)
    {
        $this->BulkId = $BulkId;
    }

    public function getBulkId(): int
    {
        return $this->BulkId;
    }

    public function setBulkId(int $BulkId): self
    {
        $this->BulkId = $BulkId;

        return $this;
    }
}
