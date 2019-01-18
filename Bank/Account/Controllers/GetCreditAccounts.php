<?php

namespace Bank\Account\Controllers;

use Bank\Account\CreditAccount;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\DiContainer;
use Twig\Environment;


class GetCreditAccounts implements ControllerInterface
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
                ->findAll();
            if(!$this->account)
            {
                throw new NotFoundException();
            }

            $twig = DiContainer::getInstance()->get(Environment::class);
            $template = $twig->load('CustomersAndAccounts.html');
            return $template->render([ 'data'=>$this->account, 'dataType'=>'Credit Accounts' , 'link'=>'account/credit/']);



        } catch (NotFoundException $e) {
            return $response->redirect("/notfound");
        }
    }
}