<?php

namespace Bank\Customer\Controllers;

use Bank\Customer\PhysicalCustomer;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\DiContainer;
use Twig\Environment;



class GetPhysicalCustomers implements ControllerInterface
{
    /**
     * @var PhysicalCustomer
     */
    private $customer;

    /**
     * @var \Katzgrau\KLogger\Logger
     */
    private $logger;

    /**
     * View constructor.
     * @param PhysicalCustomer $customer
     * @param \Katzgrau\KLogger\Logger $logger
     */
    public function __construct(
        PhysicalCustomer $customer,
        \Katzgrau\KLogger\Logger $logger
    )
    {
        $this->customer = $customer;
        $this->logger = $logger;
    }

    /**
     * @param $request
     * @param $response
     * @return mixed|string
     * @throws \Exception
     */
    public function execute($request, $response)
    {
        try {
            $this->customer = Database::GetEntityManager()->getRepository(PhysicalCustomer::class)
                ->findAll();
            if(!$this->customer)
            {
                throw new NotFoundException();

            }



            $twig = DiContainer::getInstance()->get(Environment::class);
            $template = $twig->load('CustomersAndAccounts.html');
            return $template->render([ 'data'=>$this->customer, 'dataType'=>'Physical Customers' , 'link'=>'customer/physical/']);

        } catch (NotFoundException $e) {
            return $response->redirect("/notfound");
        }
    }
}