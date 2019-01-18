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
            'path' => "/account/credit/[i:id]",
            'className' => \Bank\Account\Controllers\Credit\GetCreditAccount::class
        ],

        [
            'method' => "GET",
            'path' => "/account/credit/new",
            'className' => \Bank\Account\Controllers\Credit\NewCreditAccount::class
        ],

        [
            'method' => "GET",
            'path' => "/account/credit/edit/[i:id]",
            'className' => \Bank\Account\Controllers\Credit\EditCreditAccount::class
        ],

        [
            'method' => "POST",
            'path' => "/account/credit/delete",
            'className' => \Bank\Account\Controllers\Credit\DeleteCreditAccount::class
        ],

        [
            'method' => "POST",
            'path' => "/account/credit/save",
            'className' => \Bank\Account\Controllers\Credit\SaveCreditAccount::class
        ],




        [
            'method' => "GET",
            'path' => "/customer/business/[i:id]",
            'className' => \Bank\Customer\Controllers\Business\GetBusinessCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/customer/business/new",
            'className' => \Bank\Customer\Controllers\Business\NewBusinessCustomer::class
        ],

        [
            'method' => "POST",
            'path' => "/customer/business/save",
            'className' => \Bank\Customer\Controllers\Business\SaveBusinessCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/customer/business/edit/[i:id]",
            'className' => \Bank\Customer\Controllers\Business\EditBusinessCustomer::class
        ],

        [
            'method' => "POST",
            'path' => "/customer/business/delete",
            'className' => \Bank\Customer\Controllers\Business\DeleteBusinessCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/customer/physical/[i:id]",
            'className' => \Bank\Customer\Controllers\Physical\GetPhysicalCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/customer/physical/new",
            'className' => \Bank\Customer\Controllers\Physical\NewPhysicalCustomer::class
        ],

        [
            'method' => "POST",
            'path' => "/customer/physical/save",
            'className' => \Bank\Customer\Controllers\Physical\SavePhysicalCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/customer/physical/edit/[i:id]",
            'className' => \Bank\Customer\Controllers\Physical\EditPhysicalCustomer::class
        ],

        [
            'method' => "POST",
            'path' => "/customer/physical/delete",
            'className' => \Bank\Customer\Controllers\Physical\DeletePhysicalCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/accounts/deposit/",
            'className' => \Bank\Account\Controllers\GetDepositAccounts::class
        ],
        [
            'method' => "GET",
            'path' => "/accounts/credit/",
            'className' => \Bank\Account\Controllers\GetCreditAccounts::class
        ],
        [
            'method' => "GET",
            'path' => "/customers/physical",
            'className' => \Bank\Customer\Controllers\GetPhysicalCustomers::class
        ],
        [
            'method' => "GET",
            'path' => "/customers/business",
            'className' => \Bank\Customer\Controllers\GetBusinessCustomer::class
        ],

        [
            'method' => "GET",
            'path' => "/",
            'className' => \Bank\Controllers\MainPage::class
        ],

        [
            'method' => "GET",
            'path' => "/notfound",
            'className' => \Bank\Controllers\NotFound::class
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
