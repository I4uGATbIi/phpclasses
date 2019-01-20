<?php

namespace Bank\Account\Controllers\Deposit;

use Bank\Account\DepositAccount;
use Bank\Services\Persistance\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\Persistance\ParseMethods;

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
     * @var \Twig\Environment
     */
    private $twig;

    /**
     * View constructor.
     * @param DepositAccount $account
     * @param \Katzgrau\KLogger\Logger $logger
     * @param \Twig\Environment $twig
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
                ->find($request->id);
            $methods = ParseMethods::getMethods(DepositAccount::class);
            $renderParams = array('object' => $this->account, 'methods' => $methods, 'dataType' => 'Deposit Account',
                'link' => 'account/deposit/', 'mainData' => $this->account->getData());


            if (!$this->account) {
                throw new NotFoundException();
            }


            $template = $this->twig->load('CustomerOrAccount.html');
            return $template->render($renderParams);

        } catch (NotFoundException $e) {
            $template = $this->twig->load('noresults.html');
            return $template->render($renderParams);
        }
    }
}