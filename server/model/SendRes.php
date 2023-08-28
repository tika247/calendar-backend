<?php

declare(strict_types=1);

namespace server\model;

use server\model\DecodeHTMLSpecialChars;

/**
 * Sanitize HTML
 */
trait SendRes
{
    use DecodeHTMLSpecialChars;

/**
 * get initial schedule
 */
    private function sendRes($resData)
    {
        $res = $this->decodeHTMLSpecialChars($resData);
        echo json_encode($res);
    }
}
