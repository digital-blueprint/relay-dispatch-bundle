<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Helpers;

class Tools
{
    /**
     * Convert binary data to a data url.
     */
    public static function getDataURI(string $data, string $mime): string
    {
        return 'data:'.$mime.';base64,'.base64_encode($data);
    }
}
