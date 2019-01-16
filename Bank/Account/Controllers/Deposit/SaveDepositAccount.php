<?php

namespace Bank\Account\Controllers\Deposit;

use Bank\Account\DepositAccount;
use Bank\Services\Database;
use Bank\Services\Persistence\CantSaveException;
use Bank\Services\ControllerInterface;

class SaveDepositAccount implements ControllerInterface
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
            if($request->paramsPost()->id != null)
            {
                $this->account = Database::GetEntityManager()->getRepository(DepositAccount::class)
                    ->find($request->id);
            }
            $this->account->setMonthPercent($request->paramsPost()->percent);
            $this->account->setBalance($request->paramsPost()->price);
            $this->account->setAccountId($request->paramsPost()->accID);
            if($request->paramsPost()->id === null) {
                Database::GetEntityManager()->persist($this->account);
            }
            Database::GetEntityManager()->flush();
            return $response->redirect("/account/" . $this->account->getId());
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
