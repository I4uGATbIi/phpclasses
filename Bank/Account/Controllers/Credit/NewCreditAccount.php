<?php

namespace Bank\Account\Controllers\Credit;

use Bank\Account\CreditAccount;
use Bank\Services\ControllerInterface;

class NewCreditAccount implements ControllerInterface
{

    /**
     * @var CreditAccount
     */
    private $account;

    /**
     * @var \Katzgrau\KLogger\Logger
     */
    private $logger;

    /**
     * View constructor.
     * @param CreditAccount $account
     * @param \Katzgrau\KLogger\Logger $logger
     */
    public function __construct(
        CreditAccount $account,
        \Katzgrau\KLogger\Logger $logger
    )
    {
        $this->account = $account;
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
            $customerId = $request->paramsGet()->customerId;
            $html = <<<HTML
<form method="post" action="/account/deposit/save">
    <input type="hidden" name="customerId" value="{$customerId}">
    <label for="accID">AccID</label>
    <input name="accID">
    <label for="price">Start Deposit</label>
    <input name="price">
    <br>
    <label for="creditLimit">Credit Limit</label>
    <input name="creditLimit" value="{$this->account->getCreditLimit()}">
    <br>
	<label for="percent">Choose Percent</label>
    <select name="percent">
	<option>15</option>
	<option>20</option>
	</select>
	<br>
	<button type="submit" formaction="/account/credit/save">Open</button>

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