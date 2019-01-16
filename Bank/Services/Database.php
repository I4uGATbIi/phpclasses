<?php

namespace Bank\Services;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Database
{

    private static $connection;
    private static $entityManager;

    private static $connectionParams = array(
    'dbname' => 'bank',
    'user' => 'root',
    'password' => 'root',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
    );

    public static function GetConnection()
    {


        if(null === static::$connection) {

            $config = new \Doctrine\DBAL\Configuration();


            static::$connection = \Doctrine\DBAL\DriverManager::getConnection(static::$connectionParams, $config);
        }
        return static::$connection;

    }

    public static function GetEntityManager()
    {
        if (null === static::$entityManager)
        {
            $paths = array("/Bank");
            $isDevMode = true;

            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
            static::$entityManager = EntityManager::create(static::$connectionParams, $config);

        }

        return static::$entityManager;

    }

    private function __construct(){}

    private function __clone(){}

    private function __wakeup(){}

}