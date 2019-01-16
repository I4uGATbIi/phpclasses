<?php

namespace Bank\Account\Controllers;

use Bank\Account\Account;
use Bank\Services\Database;
use Bank\Services\Persistence\CantSaveException;
use Bank\Services\ControllerInterface;

class SaveAccount implements ControllerInterface
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
            $this->account->setAccType($request->paramsPost()->accType);
            $this->account->setBalance($request->paramsPost()->price);
            $this->account->setAccountId($request->paramsPost()->accID);
            Database::GetEntityManager()->persist($this->account);
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
