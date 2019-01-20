<?php

namespace Bank\Account\Controllers\Credit;

use Bank\Account\CreditAccount;
use Bank\Services\Database;
use Bank\Services\Persistance\CantSaveException;
use Bank\Services\ControllerInterface;

class SaveCreditAccount implements ControllerInterface
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
            if($request->paramsPost()->id != null)
            {
                $this->account = Database::GetEntityManager()->getRepository(CreditAccount::class)
                    ->find($request->id);
            }
            $this->account->setMonthPercent($request->paramsPost()->percent);
            $this->account->setBalance($request->paramsPost()->price);
            $this->account->setAccountId($request->paramsPost()->accID);
            $this->account->setCreditLimit($request->paramsPost()->creditLimit);
            if($request->paramsPost()->customerId != null) {
                $this->account->setCustomerId($request->paramsPost()->customerId);

            }
            if($request->paramsPost()->id === null) {
                Database::GetEntityManager()->persist($this->account);

            }
            Database::GetEntityManager()->flush();

            return $response->redirect("/account/credit/" . $this->account->getId());
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
