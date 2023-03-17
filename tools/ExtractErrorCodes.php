#!/usr/bin/env php
<?php
/**
 * This script is used to extract all error codes from the codebase.
 * Only works if the "ApiError::withDetails" method is used in one line.
 * You need to do a "ApiError::withDetails\(\n" regex search to find other occurrences.
 *
 * To put the output in the clipboard, in the project root run:
 * php ./tools/ExtractErrorCodes.php | xclip -sel c
 */

class ExtractErrorCodes {
    private static $ErrorCodeReplacements = [
        'Response::HTTP_BAD_REQUEST' => 400,
        'Response::HTTP_UNAUTHORIZED' => 401,
        'Response::HTTP_FORBIDDEN' => 403,
        'Response::HTTP_NOT_FOUND' => 404,
        'Response::HTTP_UNSUPPORTED_MEDIA_TYPE' => 415,
        'Response::HTTP_INTERNAL_SERVER_ERROR' => 500,
    ];

    private static $errorIds = [];

    public static function extractErrorCodesInDir($dir = '.') {
        $searchTerm = 'ApiError::withDetails(';
        $files = scandir($dir);

        foreach($files as $file) {
            if ($file == '.' || $file == '..') continue;

            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_dir($path)) {
                self::extractErrorCodesInDir($path);
            } else if (strtolower(pathinfo($path, PATHINFO_EXTENSION)) === 'php') {
                $lines = file($path);
                foreach ($lines as $line) {
                    if (strpos($line, $searchTerm) === false) continue;
                    $line = trim($line);
                    if (strpos($line, '//') === 0) continue;
                    $line = str_replace($searchTerm, '', $line);
                    $line = preg_replace('/\);$/', '', $line);
                    $line = preg_replace('/^throw /', '', $line);
                    if (strlen($line) === 0) continue;
                    $line = str_replace("'", '', $line);

                    $columns = explode(', ', $line);
                    $statusCode = $columns[0];
                    $message = $columns[1] ?? '';
                    $errorId = $columns[2] ?? '';
                    if ($errorId === '') continue;
                    if (strpos($errorId, 'dispatch:') !== 0) continue;
                    if (in_array($errorId, self::$errorIds)) continue;

                    self::$errorIds[] = $errorId;
                    $statusCode = strtr($statusCode, self::$ErrorCodeReplacements);

                    print "| `$errorId` | `$statusCode` | `$message` |\n";
                }
            }
        }
    }
}


print "| relay:errorId  | Status code | Description |\n";
print "| --- | --- | --- |\n";

ExtractErrorCodes::extractErrorCodesInDir();
