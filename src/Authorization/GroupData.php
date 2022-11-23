<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Authorization;

class GroupData
{
    /**
     * @var string
     */
    public $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getIdentifier(): string
    {
        return $this->id;
    }
}
