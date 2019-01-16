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
            'path' => "/account/deposit/[i:id]",
            'className' => \Bank\Account\Controllers\Deposit\GetDepositAccount::class
        ],

        [
            'method' => "GET",
            'path' => "/account/deposit/new",
            'className' => \Bank\Account\Controllers\Deposit\NewDepositAccount::class
        ],

        [
            'method' => "GET",
            'path' => "/account/deposit/edit/[i:id]",
            'className' => \Bank\Account\Controllers\Deposit\EditDepositAccount::class
        ],

        [
            'method' => "POST",
            'path' => "/account/deposit/delete",
            'className' => \Bank\Account\Controllers\Deposit\DeleteDepositAccount::class
        ],

        [
            'method' => "POST",
            'path' => "/account/deposit/save",
            'className' => \Bank\Account\Controllers\Deposit\SaveDepositAccount::class
        ],

        [
            'method' => "GET",
            'path' => "/business/customer/[i:id]",
            'className' => \Bank\Customer\Controllers\Business\GetBusinessCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/business/customer/new",
            'className' => \Bank\Customer\Controllers\Business\NewBusinessCustomer::class
        ],

        [
            'method' => "POST",
            'path' => "/business/customer/save",
            'className' => \Bank\Customer\Controllers\Business\SaveBusinessCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/business/customer/edit/[i:id]",
            'className' => \Bank\Customer\Controllers\Business\EditBusinessCustomer::class
        ],

        [
            'method' => "POST",
            'path' => "/business/customer/delete",
            'className' => \Bank\Customer\Controllers\Business\DeleteBusinessCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/physical/customer/[i:id]",
            'className' => \Bank\Customer\Controllers\Physical\GetPhysicalCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/physical/customer/new",
            'className' => \Bank\Customer\Controllers\Physical\NewPhysicalCustomer::class
        ],

        [
            'method' => "POST",
            'path' => "/physical/customer/save",
            'className' => \Bank\Customer\Controllers\Physical\SavePhysicalCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/physical/customer/edit/[i:id]",
            'className' => \Bank\Customer\Controllers\Physical\EditPhysicalCustomer::class
        ],

        [
            'method' => "POST",
            'path' => "/physical/customer/delete",
            'className' => \Bank\Customer\Controllers\Physical\DeletePhysicalCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/account/deposit/",
            'className' => \Bank\Account\Controllers\GetDepositAccounts::class
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
