<?php

namespace Bank\Customer\Controllers\Physical;



use Bank\Customer\PhysicalCustomer;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;



class DeletePhysicalCustomer implements ControllerInterface
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
            $customer = Database::GetEntityManager()->getRepository(PhysicalCustomer::class)
                ->find($request->id);


            Database::GetEntityManager()->remove($this->customer);
            Database::GetEntityManager()->flush();

            return "Customer deleted!";

        } catch (NotFoundException $e) {
            return "Sorry, the account not found";
        }
    }
}