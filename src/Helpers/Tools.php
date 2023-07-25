<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Helpers;

use Exception;

class Tools
{
    /**
     * Convert binary data to a data url.
     */
    public static function getDataURI(string $data, string $mime): string
    {
        return 'data:'.$mime.';base64,'.base64_encode($data);
    }

    /**
     * @throws Exception
     */
    public static function dataUriToBinary($dataUri)
    {
        $dataUriParts = explode(',', $dataUri, 2);

        if (count($dataUriParts) !== 2) {
            throw new Exception('Invalid Data URI format');
        }

        $data = base64_decode($dataUriParts[1], true);

        if ($data === false) {
            throw new Exception('Failed to decode base64 data');
        }

        return $data;
    }

    /**
     * Creates a random filename with a given extension.
     */
    public static function getTempFileName($extension = 'tmp'): string
    {
        return sys_get_temp_dir().DIRECTORY_SEPARATOR.uniqid('dispatch_').'.'.$extension;
    }

    public static function humanFileSize($bytes, $decimals = 2): string
    {
        $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $factor = (int) floor((strlen((string) $bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)).@$size[$factor];
    }
}
