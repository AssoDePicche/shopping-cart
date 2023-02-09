<?php

declare(strict_types=1);

namespace Util;

final class JsonParser
{
    public static function encode(mixed $data): string
    {
        $json = json_encode(
            $data,
            JSON_PRETTY_PRINT
                | JSON_UNESCAPED_UNICODE
                | JSON_UNESCAPED_SLASHES
                | JSON_HEX_TAG
                | JSON_HEX_QUOT
                | JSON_HEX_AMP
                | JSON_HEX_APOS
                | JSON_FORCE_OBJECT
                | JSON_PRESERVE_ZERO_FRACTION
        );

        if (!json_last_error()) {
            return $json;
        }

        throw new \RuntimeException(json_last_error_msg());
    }

    public static function decode(string $json): array
    {
        $data = json_decode($json, true);

        if (!json_last_error()) {
            return $data;
        }

        throw new \RuntimeException(json_last_error_msg());
    }
}
