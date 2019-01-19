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
     * @var \Twig\Environment
     */
    private $twig;

    /**
     * View constructor.
     * @param PhysicalCustomer $customer
     * @param \Katzgrau\KLogger\Logger $logger
     * @param Environment $twig
     */
    public function __construct(
        PhysicalCustomer $customer,
        \Katzgrau\KLogger\Logger $logger,
        \Twig\Environment $twig
    )
    {
        $this->customer = $customer;
        $this->logger = $logger;
        $this->twig = $twig;
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
            $renderParams = array( 'data'=>$this->customer, 'dataType'=>'Physical Customers' , 'link'=>'customer/physical/');
            if(!$this->customer)
            {
                throw new NotFoundException();

            }




            $template = $this->twig->load('CustomersAndAccounts.html');
            return $template->render($renderParams);

        } catch (NotFoundException $e) {
            $template=$this->twig->load('noresults.html');
            return  $template->render($renderParams);
        }
    }
}