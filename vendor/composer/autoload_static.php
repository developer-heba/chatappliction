<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc4988a739d1e487c3d5706d735f22341
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc4988a739d1e487c3d5706d735f22341::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc4988a739d1e487c3d5706d735f22341::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc4988a739d1e487c3d5706d735f22341::$classMap;

        }, null, ClassLoader::class);
    }
}
