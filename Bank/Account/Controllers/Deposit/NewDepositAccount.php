<?php

namespace Bank\Account\Controllers\Deposit;

use Bank\Account\DepositAccount;
use Bank\Services\ControllerInterface;

class NewDepositAccount implements ControllerInterface
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
    <label for="price">Start Limit</label>
    <input name="price">
    <br>
	<label for="percent">Choose Percent</label>
    <select name="percent">
	<option>15</option>
	<option>20</option>
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