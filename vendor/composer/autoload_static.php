<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3ee671843d6a37997f308c9633568835
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit3ee671843d6a37997f308c9633568835::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3ee671843d6a37997f308c9633568835::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3ee671843d6a37997f308c9633568835::$classMap;

        }, null, ClassLoader::class);
    }
}
