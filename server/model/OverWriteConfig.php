<?php

declare(strict_types=1);

namespace server\model;

/**
 * Sanitize HTML
 */
trait OverWriteConfig
{
/**
 * update config
 */
    private function overWriteConfig($configPath, $config)
    {
        $newConfig = json_encode($config, JSON_UNESCAPED_UNICODE);
        file_put_contents($configPath, $newConfig); // = fopen(), fwrite(),  fclose()
    }
}
