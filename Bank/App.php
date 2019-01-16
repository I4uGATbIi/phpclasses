<?php

namespace Bank;
use Bank\Services\Database;
class App
{
    public static function run()
    {



        try {
            $em = Database::GetEntityManager();
            $db = Database::GetConnection();

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