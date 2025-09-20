<?php

declare(strict_types=1);

namespace App\Helpers;

final class PathHelper
{
    /**
     * Path https://localhost/
     */
    public static function getAppUrlDs(): string
    {
        return EnvHelper::getAppUrlDs();
    }

    // /**
    //  * Path https://code-base.ru/monaco-editor@0.52.0/loader.js
    //  */
    // public static function getPublicMonacoEditor(): string
    // {
    //     return self::getPublicDirectory() . 'monaco-editor@0.52.0/loader.js';
    // }

    // /**
    //  * Path /public/
    //  */
    // public static function getPublicPath(): string
    // {
    //     return self::getRootPath() . 'public' . DIRECTORY_SEPARATOR;
    // }

    // /**
    //  * Path /public/build/
    //  */
    // public static function getPublicBuildPath(): string
    // {
    //     return self::getPublicPath() . 'build' . DIRECTORY_SEPARATOR;
    // }

    // /**
    //  * Path /public/images/
    //  */
    // public static function getPublicImagesPath(): string
    // {
    //     return self::getPublicPath() . 'images' . DIRECTORY_SEPARATOR;
    // }

    /**
     * Path /
     */
    public static function getRootPath(): string
    {
        return realpath(__DIR__ . '/../../') . DIRECTORY_SEPARATOR;
    }

    /**
     * Path /vendor/
     */
    public static function getVendorPath(): string
    {
        return self::getRootPath() . 'vendor' . DIRECTORY_SEPARATOR;
    }

    /**
     * Path /tests/
     */
    public static function getTestsPath(): string
    {
        return self::getRootPath() . 'tests' . DIRECTORY_SEPARATOR;
    }

    public static function getTestsSupportDataPath(): string
    {
        return self::getTestsPath()
            . 'Support'
            . DIRECTORY_SEPARATOR
            . 'Data'
            . DIRECTORY_SEPARATOR;
    }

    // /**
    //  * Path /app/
    //  */
    // public static function getAppPath(): string
    // {
    //     return self::getRootPath() . 'app' . DIRECTORY_SEPARATOR;
    // }

    // /**
    //  * Path /app/views/
    //  */
    // public static function getViewsPath(): string
    // {
    //     return self::getAppPath() . 'views' . DIRECTORY_SEPARATOR;
    // }

    // /**
    //  * Path /app/views/web/
    //  */
    // public static function getViewsWebPath(): string
    // {
    //     return self::getViewsPath() . 'web' . DIRECTORY_SEPARATOR;
    // }

    // /**
    //  * Path /app/views/web/index/
    //  */
    // public static function getViewsWebIndexPath(): string
    // {
    //     return self::getViewsWebPath() . 'index' . DIRECTORY_SEPARATOR;
    // }

    // /**
    //  * Path /app/views/web/_includes/
    //  */
    // public static function getViewsWebIndexIncludesPath(): string
    // {
    //     return self::getViewsWebIndexPath() . '_includes' . DIRECTORY_SEPARATOR;
    // }

    // /**
    //  * Path /app/views/web/_includes/breadcrumb.php
    //  */
    // public static function getViewsWebIndexIncludesBreadcrumbPath(): string
    // {
    //     return self::getViewsWebIndexIncludesPath() . 'breadcrumb.php';
    // }

    // /**
    //  * Path /app/views/mail/
    //  */
    // public static function getViewsMailPath(): string
    // {
    //     return self::getViewsPath() . 'mail' . DIRECTORY_SEPARATOR;
    // }

    // /**
    //  * Path /app/views/mail/index/
    //  */
    // public static function getViewsMailIndexPath(): string
    // {
    //     return self::getViewsMailPath() . 'index' . DIRECTORY_SEPARATOR;
    // }

    /**
     * Path /src/
     */
    public static function getSrcPath(): string
    {
        return self::getRootPath() . 'src' . DIRECTORY_SEPARATOR;
    }

    /**
     * Path /src/Entity/
     */
    public static function getSrcEntityPath(): string
    {
        return self::getSrcPath() . 'Entity' . DIRECTORY_SEPARATOR;
    }

    // /**
    //  * Path /logs/
    //  */
    // public static function getLogsPath(): string
    // {
    //     return self::getRootPath() . 'logs' . DIRECTORY_SEPARATOR;
    // }

    // /**
    //  * Path /logs/app/
    //  */
    // public static function getLogsAppPath(): string
    // {
    //     return self::getLogsPath() . 'app' . DIRECTORY_SEPARATOR;
    // }

    /**
     * Path /templates/
     */
    public static function getTemplatesPath(): string
    {
        return self::getRootPath() . 'templates' . DIRECTORY_SEPARATOR;
    }

    /**
     * Path /templates/twig/
     */
    public static function getTemplatesTwigPath(): string
    {
        return self::getTemplatesPath() . 'twig' . DIRECTORY_SEPARATOR;
    }

    /**
     * Path /var/
     */
    public static function getVarPath(): string
    {
        return self::getRootPath() . 'var' . DIRECTORY_SEPARATOR;
    }

    /**
     * Path /var/cache/
     */
    public static function getCachePath(): string
    {
        return self::getVarPath() . 'cache' . DIRECTORY_SEPARATOR;
    }

    /**
     * Path /var/cache/twig/
     */
    public static function getCacheTwigPath(): string
    {
        return self::getCachePath() . 'twig' . DIRECTORY_SEPARATOR;
    }
}
