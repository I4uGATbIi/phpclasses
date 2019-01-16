<?php

namespace Bank\Customer\Controllers\Physical;


use Bank\Customer\PhysicalCustomer;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;



class EditPhysicalCustomer implements ControllerInterface
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

            if(!$customer)
            {
                throw new NotFoundException();
            }




            $html = <<<HTML
<form method="post" action="/customer/save">
    <input type="hidden" name="id" value="{$customer->getId()}">
    <label for="name">Name</label>
    <input name="name" value="{$customer->getName()}">
    <br>
    <label for="taxCode">Tax Code</label>
    <input name="taxCode" value="{$customer->getTaxCode()}">
    <br>
    <label for="pdvCode">PDV Code</label>
    <input name="pdvCode" value="{$customer->getPdvCode()}">
    <br>
	<button type="submit" >Save</button>
	<button type="submit" formaction="/customer/delete">Delete</button>

</form>

HTML;
            return $html;

        }
        catch (NotFoundException $e) {
            return "Sorry, the account not found";
        }
        catch (\Bank\Services\SystemException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Oops, something went wrong, Our team is looking for solution";
        }
    }
}