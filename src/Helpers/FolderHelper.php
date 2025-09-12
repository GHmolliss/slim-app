<?php

declare(strict_types=1);

namespace App\Helpers;

use RuntimeException;

class FolderHelper
{
    public static function createFolderIfNotExists(string $path): bool
    {
        if (is_dir($path)) {
            return true;
        }

        if (!mkdir($path, 0777, true) && ! is_dir($path)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
        }

        return true;
    }

    public static function cleanFolder(string $folder): void
    {
        foreach (scandir($folder) as $file) {
            if (! in_array($file, ['parsed', '.', '..'])) {
                unlink($folder . $file);
            }
        }
    }

    public static function removeFolder(string $path): void
    {
        self::removeFolderContents($path);

        if (is_dir($path)) {
            rmdir($path);
        }
    }

    public static function removeFolderContents(string $path): void
    {
        $path = rtrim($path, '/');

        $files = glob($path . '/*') ?: [];

        foreach ($files as $file) {
            if (is_dir($file) && !is_link($path)) {
                self::removeFolder($file);
            } else {
                unlink($file);
            }
        }
    }
}
