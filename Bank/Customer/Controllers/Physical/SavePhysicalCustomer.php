<?php

namespace Bank\Customer\Controllers\Physical;

use Bank\Customer\PhysicalCustomer;
use Bank\Services\Database;
use Bank\Services\Persistence\CantSaveException;
use Bank\Services\ControllerInterface;

class SavePhysicalCustomer implements ControllerInterface
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
            if($request->paramsPost()->id != null)
            {
                $this->customer = Database::GetEntityManager()->getRepository(PhysicalCustomer::class)
                    ->find($request->id);
            }
            $this->customer->setName($request->paramsPost()->name);
            $this->customer->setPdvCode($request->paramsPost()->pdvCode);
            $this->customer->setTaxCode($request->paramsPost()->taxCode);
            if($request->paramsPost()->id === null) {
                Database::GetEntityManager()->persist($this->customer);
            }
            Database::GetEntityManager()->flush();
            return $response->redirect("/customer/" . $this->customer->getId());
        } catch (CantSaveException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Sorry, the customer can't be saved";
        } catch (\Bank\Services\SystemException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Oops, something went wrong, Our team is looking for solution";
        }
    }
}
