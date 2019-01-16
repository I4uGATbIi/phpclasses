<?php

const DOCKROOT = __DIR__;
include_once __DIR__ . "/vendor/autoload.php";

set_error_handler(function ($errno , $errstr) {
    throw new Bank\Services\SystemException($errstr, $errno);
}, E_ALL);

Bank\App::run();