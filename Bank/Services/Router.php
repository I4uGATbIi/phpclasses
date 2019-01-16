<?php

namespace Bank\Services;

class Router
{

    /**
     * @var array
     */
    public $routes = [
        [
            'method' => "GET",
            'path' => "/migrate/",
            'className' => Database\MigrateController::class
        ],

        [
            'method' => "GET",
            'path' => "/account/[i:id]",
            'className' => \Bank\Account\Controllers\GetAccount::class
        ],

        [
            'method' => "GET",
            'path' => "/account/new",
            'className' => \Bank\Account\Controllers\NewAccount::class
        ],

        [
            'method' => "POST",
            'path' => "/account/save",
            'className' => \Bank\Account\Controllers\SaveAccount::class
        ],
    ];

    /**
     * Routing entry point
     */
    public function dispatch()
    {
        $klein = new \Klein\Klein();

        foreach ($this->routes as $route) {
            $klein->respond(
                $route['method'],
                $route['path'],
                function ($request, $response) use ($route) {
                    $controller = DiContainer::getInstance()->get($route['className']);

                    if ($controller instanceof ControllerInterface) {

                        return $controller->execute($request, $response);

                    } else {

                        throw new SystemException('Controller Class not found');

                    }
                });
        }
        $klein->dispatch();
    }
}
