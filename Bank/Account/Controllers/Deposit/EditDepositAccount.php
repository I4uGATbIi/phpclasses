<?php

namespace Bank\Account\Controllers\Deposit;

use Bank\Account\DepositAccount;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\Persistence\NotFoundException;

class EditDepositAccount implements ControllerInterface
{

    /**
     * @var DepositAccount
     */
    private $account;

    /**
     * @var \Katzgrau\KLogger\Logger
     */
    private $logger;

    /**
     * View constructor.
     * @param DepositAccount $account
     * @param \Katzgrau\KLogger\Logger $logger
     */
    public function __construct(
        DepositAccount $account,
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

            $account = Database::GetEntityManager()->getRepository(DepositAccount::class)
                ->find($request->id);

            if(!$account)
            {
                throw new NotFoundException();
            }




            $html = <<<HTML
<form method="post" action="/account/save">
    <input type="hidden" name="id" value="{$account->getId()}">
    <input type="hidden" name="accID" value="{$account->getAccountId()}">
    <input type="hidden" name="percent" value="{$account->getMonthPercent()}">
    <label for="price">Set Balance</label>
    <input name="price" value="{$account->getBalance()}">
    <br>
	<button type="submit">Save</button>
	<button type="submit" formaction="/account/delete">Close Account</button>

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