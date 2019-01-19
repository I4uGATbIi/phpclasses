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

            $this->customer = Database::GetEntityManager()->getRepository(PhysicalCustomer::class)
                ->find($request->id);

            if(!$this->customer)
            {

                    throw new NotFoundException();

            }




            $html = <<<HTML
<form method="post" action="/customer/physical/save">
    <input type="hidden" name="id" value="{$this->customer->getId()}">
    <input type="hidden" name="IPN" value="{$this->customer->getIPN()}">
    <input type="hidden" name="passportCode" value="{$this->customer->getPassportCode()}">
    <label for="firstName">First Name</label>
    <input name="firstName" value="{$this->customer->getFirstName()}">
    <br>
    <label for="lastName">Last Name</label>
    <input name="lastName" value="{$this->customer->getLastName()}">
    <br>
    <label for="age">Age</label>
    <input name="age" value="{$this->customer->getAge()}">
    <br>
	<button type="submit" >Save</button>
	<button type="submit" formaction="/customer/physical/delete">Delete</button>

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