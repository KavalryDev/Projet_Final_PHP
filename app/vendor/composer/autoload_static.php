<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit89967c1e12b12c5eb1b242e2563cc04f
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit89967c1e12b12c5eb1b242e2563cc04f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit89967c1e12b12c5eb1b242e2563cc04f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit89967c1e12b12c5eb1b242e2563cc04f::$classMap;

        }, null, ClassLoader::class);
    }
}
