<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Serializer;

use Dbp\Relay\CoreBundle\Authorization\Serializer\AbstractEntityNormalizer;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;

class RequestRecipientNormalizer extends AbstractEntityNormalizer
{
    public function __construct()
    {
        parent::__construct([RequestRecipient::class]);
    }
}
