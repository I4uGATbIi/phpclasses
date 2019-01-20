<?php

namespace Bank\Customer\Controllers;

use Bank\Customer\BusinessCustomer;
use Bank\Services\Persistance\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\DiContainer;
use Twig\Environment;



class GetBusinessCustomer implements ControllerInterface
{
    /**
     * @var BusinessCustomer
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
     * @param BusinessCustomer $customer
     * @param \Katzgrau\KLogger\Logger $logger
     */
    public function __construct(
        BusinessCustomer $customer,
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
            $this->customer = Database::GetEntityManager()->getRepository(BusinessCustomer::class)
                ->findAll();
            $renderParams = array('data'=>$this->customer, 'dataType'=>'Business Customers' , 'link'=>'customer/business/');

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