<?php

namespace Bank\Account\Controllers;

use Bank\Account\Account;
use Bank\Services\ControllerInterface;

class NewAccount implements ControllerInterface
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
<form method="post" action="/account/save">
    
    <label for="accID">AccID</label>
    <input name="accID">
    <label for="price">Price</label>
    <input name="price">
    <br>
    <label for="accType">Account Type</label>
    <select name="accType">
	<option>Deposit</option>
	<option>Credit</option>
	</select>
	<br>
	<button type="submit">Open</button>

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