<?php

namespace Bank\Account\Controllers\Deposit;

use Bank\Account\DepositAccount;
use Bank\Services\ControllerInterface;
use Bank\Services\DiContainer;
use Twig\Environment;

class NewDepositAccount implements ControllerInterface
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
            $customerId = $request->paramsGet()->customerId;

            $twig = DiContainer::getInstance()->get(Environment::class);
            $template = $twig->load('NewDeposit.html');
            return $template->render([ 'customerId'=>$customerId ]);

        } catch (\Bank\Services\SystemException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Oops, something went wrong, Our team is looking for solution";
        }
    }
}