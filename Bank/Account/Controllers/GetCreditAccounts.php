<?php

namespace Bank\Account\Controllers;

use Bank\Account\CreditAccount;
use Bank\Services\Persistance\NotFoundException;
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
     * @var \Twig\Environment
     */
    private $twig;

    /**
     * View constructor.
     * @param CreditAccount $account
     * @param \Katzgrau\KLogger\Logger $logger
     */
    public function __construct(
        CreditAccount $account,
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
            $this->account = Database::GetEntityManager()->getRepository(CreditAccount::class)
                ->findAll();
            $renderParams = array('data' => $this->account, 'dataType' => 'Credit Accounts', 'link' => 'account/credit/');
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