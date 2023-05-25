<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo;

class Vendo
{
    /**
     * Whether the GZ (MetaData::GZ) is valid.
     */
    public static function isValidGZForSubmission(string $gz): bool
    {
        // New information from Vendo 2023-01-16: A GZ is mandatory for postal delivery, max 25 chars
        if (trim($gz) === '') {
            return false;
        }
        if (mb_strlen($gz) > 25) {
            return false;
        }

        return true;
    }
}
