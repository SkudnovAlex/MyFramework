<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita0c959c9e74a4ddb3b6b1ee717f51048
{
    public static $prefixLengthsPsr4 = array (
        'i' => 
        array (
            'ishop\\' => 6,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ishop\\' => 
        array (
            0 => __DIR__ . '/..' . '/ishop/core',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita0c959c9e74a4ddb3b6b1ee717f51048::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita0c959c9e74a4ddb3b6b1ee717f51048::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
