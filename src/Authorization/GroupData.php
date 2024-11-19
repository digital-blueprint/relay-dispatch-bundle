<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Authorization;

class GroupData
{
    public function __construct(private readonly string $identifier)
    {
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
