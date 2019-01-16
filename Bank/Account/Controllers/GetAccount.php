<?php

namespace Bank\Account\Controllers;

use Bank\Account\Account;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;

/**
 * @Route("/account/{id}", name="account_get")
 */

class GetAccount implements ControllerInterface
{
    /**
     * @var Account
     */
    private $account;

    /**
     * @var \Katzgrau\KLogger\Logger
     */
    private $logger;

    /**
     * View constructor.
     * @param Account $product
     * @param \Katzgrau\KLogger\Logger $logger
     */
    public function __construct(
        Account $account,
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
            $account = Database::GetEntityManager()->getRepository(Account::class)
                ->find($request->id);

            return print_r($account, true);

        } catch (NotFoundException $e) {
            return "Sorry, the account not found";
        }
    }
}