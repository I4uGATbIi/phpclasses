<?php

namespace Bank\Customer\Controllers\Business;

use Bank\Customer\BussinessCustomer;
use Bank\Services\ControllerInterface;

class NewBusinessCustomer implements ControllerInterface
{

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
<form method="post" action="/customer/business/save">
    
    <label for="name">Name</label>
    <input name="name">
    <br>
    <label for="taxCode">Tax Code</label>
    <input name="taxCode">
    <br>
    <label for="pdvCode">PDV Code</label>
    <input name="pdvCode">
    <br>
	<button type="submit">Save</button>

</form>

HTML;
            return $html;

        } catch (\Bank\Services\SystemException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Oops, something went wrong, Our team is looking for solution";
        }
    }
}