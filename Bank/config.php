<?php

return [
    "log.errorFile" => DOCKROOT . '/var/log',




    \Katzgrau\KLogger\Logger::class => DI\create()
        ->constructor(DI\get('log.errorFile')),


//    Bank\Services\Database::class => DI\create()
//        ->constructor(DI\get('database')),

    "Bank\Customer\ICustomer" => DI\create('Bank\Customer\BussinessCustomer'),
];