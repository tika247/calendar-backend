<?php

declare(strict_types=1);

namespace server\model;

/**
 * Sanitize HTML
 */
trait DecodeHTMLSpecialChars
{
/**
 * get initial schedule
 */
    private function decodeHTMLSpecialChars($targetData)
    {
        if (!$targetData) {
            return;
        }

        return $this->decodeFunc($targetData);
    }

    private function decodeFunc($data)
    {
        if (is_array($data) || is_object($data)) {
            foreach ($data as &$value) {
                $value = $this->decodeFunc($value);
            }
            unset($value);
        } elseif (is_string($data)) {
            $data = htmlspecialchars_decode($data);
        }
        return $data;
    }
}
