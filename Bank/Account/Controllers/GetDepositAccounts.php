<?php

namespace Bank\Account\Controllers;

use Bank\Account\DepositAccount;
use Bank\Account\AccountInterface;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\DiContainer;
use Twig\Environment;


class GetDepositAccounts implements ControllerInterface
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
     * @var \Twig\Environment
     */
    private $twig;

    /**
     * View constructor.
     * @param DepositAccount $account
     * @param \Katzgrau\KLogger\Logger $logger
     */
    public function __construct(
        DepositAccount $account,
        \Katzgrau\KLogger\Logger $logger,
        \Twig\Environment $twig
    )
    {
        $this->account = $account;
        $this->logger = $logger;
        $this->twig = $twig;
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
                ->findAll();
            $renderParams = array('data' => $this->account, 'dataType' => 'Deposit Accounts', 'link' => 'account/deposit/');
            if (!$this->account) {
                throw new NotFoundException();
            }


            $template = $this->twig->load('CustomersAndAccounts.html');
            return $template->render($renderParams);


        } catch (NotFoundException $e) {
            $template=$this->twig->load('noresults.html');
            return  $template->render($renderParams);
        }
    }
}