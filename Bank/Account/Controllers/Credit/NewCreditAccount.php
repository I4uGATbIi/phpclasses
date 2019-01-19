<?php

namespace Bank\Account\Controllers\Credit;

use Bank\Account\CreditAccount;
use Bank\Services\ControllerInterface;

class NewCreditAccount implements ControllerInterface
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
     * @param \Twig\Environment $twig
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
            $customerId = $request->paramsGet()->customerId;
            $renderParams = array($customerId);

            $template = $this->twig->load('NewCredit.html');
            return $template->render($renderParams);

        } catch (\Bank\Services\SystemException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Oops, something went wrong, Our team is looking for solution";
        }
    }
}