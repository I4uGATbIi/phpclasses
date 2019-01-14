<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitff8f55a12a1eb0d87be499c42edb0032
{
    public static $prefixLengthsPsr4 = array (
        'o' => 
        array (
            'orm\\' => 4,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'K' => 
        array (
            'Klein\\' => 6,
            'Katzgrau\\KLogger\\' => 17,
        ),
        'B' => 
        array (
            'Bank\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'orm\\' => 
        array (
            0 => __DIR__ . '/..' . '/sagrishin/lightweight-php-orm/lib/orm',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Klein\\' => 
        array (
            0 => __DIR__ . '/..' . '/klein/klein/src/Klein',
        ),
        'Katzgrau\\KLogger\\' => 
        array (
            0 => __DIR__ . '/..' . '/katzgrau/klogger/src',
        ),
        'Bank\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Bank',
        ),
    );

    public static $classMap = array (
        'Bank\\Account\\CommonAccount' => __DIR__ . '/../..' . '/Bank/Account/CommonAccount.php',
        'Bank\\Customer\\BussinessCustomer' => __DIR__ . '/../..' . '/Bank/Customer/BussinessCustomer.php',
        'Bank\\Customer\\ICustomer' => __DIR__ . '/../..' . '/Bank/Customer/ICutomer.php',
        'Bank\\Customer\\PhysCustomer' => __DIR__ . '/../..' . '/Bank/Customer/PhysCustomer.php',
        'Katzgrau\\KLogger\\Logger' => __DIR__ . '/..' . '/katzgrau/klogger/src/Logger.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitff8f55a12a1eb0d87be499c42edb0032::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitff8f55a12a1eb0d87be499c42edb0032::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitff8f55a12a1eb0d87be499c42edb0032::$classMap;

        }, null, ClassLoader::class);
    }
}
