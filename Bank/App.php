<?php

namespace Bank;
use Bank\Services\Database;
use Bank\Services\DiContainer;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
class App
{
    public static function run()
    {



        try {
            Database::GetEntityManager();
            Database::GetConnection();

            $router = new Services\Router();
            $router->dispatch();
        } catch (Services\SystemException $e) {
            echo "Oops... Something Went Wrong";
            echo $e->getMessage();
        } catch (\Exception $e) {
            echo "Oops... Something Went Wrong";
            echo $e->getMessage();
        }
    }
}