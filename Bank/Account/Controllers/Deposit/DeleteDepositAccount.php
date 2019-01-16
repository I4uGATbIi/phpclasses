<?php

namespace Bank\Account\Controllers\Deposit;

use Bank\Account\DepositAccount;
use Bank\Services\Database;
use Bank\Services\Persistence\CantSaveException;
use Bank\Services\ControllerInterface;

class DeleteDepositAccount implements ControllerInterface
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
     * @param DepositAccount $product
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

                $this->account = Database::GetEntityManager()->getRepository(DepositAccount::class)
                    ->find($request->id);
                if ($this->account->CheckForClosing()) {
                    Database::GetEntityManager()->remove($this->account);
                    Database::GetEntityManager()->flush();
                    return "Account closed!";//$response->redirect("/account/" . $this->account->getId());
                }
            return "You cannot close account with negative balance";
        } catch (CantSaveException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Sorry, the product can't be saved";
        } catch (\Bank\Services\SystemException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Oops, something went wrong, Our team is looking for solution";
        }
    }
}