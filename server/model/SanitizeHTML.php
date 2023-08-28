<?php

declare(strict_types=1);

namespace server\model;

/**
 * Sanitize HTML
 */
trait SanitizeHTML
{
/**
 * get initial schedule
 */
    private function sanitizeHTML($reqData)
    {
        if (!$reqData) {
            return;
        }

          return $this->sanitizeFunc($reqData);
    }
    private function sanitizeFunc($data)
    {
        if (is_array($data) || is_object($data)) {
            foreach ($data as &$value) {
                $value = $this->sanitizeFunc($value);
            }
            unset($value);
        } elseif (is_string($data)) {
            $data = htmlspecialchars($data);
        }
        return $data;
    }
}
