<?php

namespace Bank\Account\Controllers\Credit;

use Bank\Account\CreditAccount;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\Persistence\NotFoundException;

class EditCreditAccount implements ControllerInterface
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

            $this->account = Database::GetEntityManager()->getRepository(CreditAccount::class)
                ->find($request->id);

            if(!$this->account)
            {
                throw new NotFoundException();
            }




            $html = <<<HTML
<form method="post" action="/account/deposit/save">
    <input type="hidden" name="id" value="{$this->account->getId()}">
    <input type="hidden" name="customerId" value="{$this->account->getCustomerId()}">
    <input type="hidden" name="accID" value="{$this->account->getAccountId()}">
    <input type="hidden" name="percent" value="{$this->account->getMonthPercent()}">
    <label for="price">Set Balance</label>
    <input name="price" value="{$this->account->getBalance()}">
    <br>
    <label for="creditLimit">Credit Limit</label>
    <input name="creditLimit" value="{$this->account->getCreditLimit()}">
    <br>
	<button type="submit">Save</button>
	<button type="submit" formaction="/account/credit/delete">Close Account</button>

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