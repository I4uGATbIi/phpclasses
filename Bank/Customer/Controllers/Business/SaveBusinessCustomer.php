<?php

namespace Bank\Customer\Controllers\Business;

use Bank\Customer\BussinessCustomer;
use Bank\Customer\ICustomer;
use Bank\Services\Database;
use Bank\Services\Persistence\CantSaveException;
use Bank\Services\ControllerInterface;

class SaveBusinessCustomer implements ControllerInterface
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
            if($request->paramsPost()->id != null)
            {
                $this->customer = Database::GetEntityManager()->getRepository(BussinessCustomer::class)
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

            return "Sorry, the product can't be saved";
        } catch (\Bank\Services\SystemException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Oops, something went wrong, Our team is looking for solution";
        }
    }
}
