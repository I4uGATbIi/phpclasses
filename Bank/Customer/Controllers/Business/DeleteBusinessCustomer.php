<?php

namespace Bank\Customer\Controllers\Business;

use Bank\Customer\BussinessCustomer;
use Bank\Customer\ICustomer;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;



class DeleteBusinessCustomer implements ControllerInterface
{
    /**
     * @var BussinessCustomer
     */
    private $customer;

    /**
     * @var \Katzgrau\KLogger\Logger
     */
    private $logger;

    /**
     * View constructor.
     * @param BussinessCustomer $product
     * @param \Katzgrau\KLogger\Logger $logger
     */
    public function __construct(
        BussinessCustomer $customer,
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
            $customer = Database::GetEntityManager()->getRepository(BussinessCustomer::class)
                ->find($request->id);


            Database::GetEntityManager()->remove($this->customer);
            Database::GetEntityManager()->flush();

            return "Customer deleted!";

        } catch (NotFoundException $e) {
            return "Sorry, the account not found";
        }
    }
}