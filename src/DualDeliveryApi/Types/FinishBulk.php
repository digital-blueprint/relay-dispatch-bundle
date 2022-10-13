<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return int
     */
    public function getBulkId()
    {
        return $this->BulkId;
    }

    /**
     * @param int $BulkId
     *
     * @return FinishBulk
     */
    public function setBulkId($BulkId)
    {
        $this->BulkId = $BulkId;

        return $this;
    }
}
