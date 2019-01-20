<?php

namespace Bank\Customer\Controllers\Business;

use Bank\Customer\BusinessCustomer;
use Bank\Services\Persistance\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;



class EditBusinessCustomer implements ControllerInterface
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
     * View constructor.
     * @param BusinessCustomer $customer
     * @param \Katzgrau\KLogger\Logger $logger
     */
    public function __construct(
        BusinessCustomer $customer,
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

            $this->customer = Database::GetEntityManager()->getRepository(BusinessCustomer::class)
                ->find($request->id);

            if(!$this->customer)
            {
                throw new NotFoundException();
            }




            $html = <<<HTML
<form method="post" action="/customer/save">
    <input type="hidden" name="id" value="{$this->customer->getId()}">
    <label for="name">Name</label>
    <input name="name" value="{$this->customer->getName()}">
    <br>
    <label for="taxCode">Tax Code</label>
    <input name="taxCode" value="{$this->customer->getTaxCode()}">
    <br>
    <label for="pdvCode">PDV Code</label>
    <input name="pdvCode" value="{$this->customer->getPdvCode()}">
    <br>
	<button type="submit" >Save</button>
	<button type="submit" formaction="/customer/business/delete">Delete</button>

</form>
<button onclick="goBack()">Go Back</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>


HTML;
            return $html;

        }
        catch (NotFoundException $e) {
            return $response->redirect("/notfound");
        }
        catch (\Bank\Services\SystemException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Oops, something went wrong, Our team is looking for solution";
        }
    }
}