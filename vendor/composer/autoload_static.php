<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdc053dea52cd0ba0200d34f8b6f3442c
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdc053dea52cd0ba0200d34f8b6f3442c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdc053dea52cd0ba0200d34f8b6f3442c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
