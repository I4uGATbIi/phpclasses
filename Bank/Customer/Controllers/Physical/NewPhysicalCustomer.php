<?php

namespace Bank\Customer\Controllers\Physical;

use Bank\Customer\PhysicalCustomer;
use Bank\Services\ControllerInterface;

class NewPhysicalCustomer implements ControllerInterface
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
            $html = <<<HTML
<form method="post" action="/customer/physical/save">
    
    <label for="firstName">First Name</label>
    <input name="firstName">
    <br>
    <label for="lastName">Last Name</label>
    <input name="lastName">
    <br>
    <label for="age">Age</label>
    <input name="age">
    <br>
    <label for="IPN">IPN</label>
    <input name="IPN">
    <br>
    <label for="passportCode">Passport Code</label>
    <input name="passportCode">
    <br>
	<button type="submit">Save</button>

</form>
<button onclick="goBack()">Go Back</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>


HTML;
            return $html;

        } catch (\Bank\Services\SystemException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Oops, something went wrong, Our team is looking for solution";
        }
    }
}