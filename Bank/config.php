<?php

return [
    "log.errorFile" => DOCKROOT . '/var/log',

    "twig.templatesRoot" => DOCKROOT . '/templates',

    "twig.enviroment" =>
        [
            'cache' => DOCKROOT . '/cache',
            'debug' => true,
        ],



    Twig\Loader\LoaderInterface::class =>
        DI\get(Twig\Loader\FilesystemLoader::class),
    Twig_LoaderInterface::class =>
        DI\get(Twig\Loader\FilesystemLoader::class),
    Twig\Loader\FilesystemLoader::class =>
        DI\create()->constructor(DI\get('twig.templatesRoot')),

    Twig\Environment::class =>
        DI\create()->constructor(DI\get(\Twig\Loader\LoaderInterface::class), DI\get('twig.enviroment')),

    \Katzgrau\KLogger\Logger::class => DI\create()
        ->constructor(DI\get('log.errorFile')),


//    Bank\Services\Database::class => DI\create()
//        ->constructor(DI\get('database')),


    "Bank\Customer\CustomerInterface" => DI\create('Bank\Customer\PhysicalCustomer'),
];