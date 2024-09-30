<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita0c8d588f21c6a5a866a3481dd3105e5
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'setasign\\Fpdi\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'setasign\\Fpdi\\' => 
        array (
            0 => __DIR__ . '/..' . '/setasign/fpdi/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'TTFontFile' => __DIR__ . '/..' . '/setasign/tfpdf/font/unifont/ttfonts.php',
        'tFPDF' => __DIR__ . '/..' . '/setasign/tfpdf/tfpdf.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita0c8d588f21c6a5a866a3481dd3105e5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita0c8d588f21c6a5a866a3481dd3105e5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita0c8d588f21c6a5a866a3481dd3105e5::$classMap;

        }, null, ClassLoader::class);
    }
}
