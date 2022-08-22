<?php

namespace App\Http\Methods;

use League\MimeTypeDetection\GeneratedExtensionToMimeTypeMap;

class FileExtensionDetector
{
    public static function lookupExtension($mimeType)
    {
        $arr = array_flip(GeneratedExtensionToMimeTypeMap::MIME_TYPES_FOR_EXTENSIONS);
        return $arr[$mimeType] ?? null;
    }
}
