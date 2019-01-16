<?php

namespace Bank\Account\Controllers\Deposit;

use Bank\Account\DepositAccount;
use Bank\Account\AccountInterface;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;

/**
 * @Route("/account/{id}", name="account_get")
 */

class GetDepositAccount implements ControllerInterface
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

            return print_r($account, true);

        } catch (NotFoundException $e) {
            return "Sorry, the account not found";
        }
    }
}