<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Message;

use Dbp\Relay\DispatchBundle\Entity\Request;

class RequestSubmissionMessage
{
    public function __construct(private readonly Request $request)
    {
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
