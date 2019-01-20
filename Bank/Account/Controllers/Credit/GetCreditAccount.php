<?php

namespace Bank\Account\Controllers\Credit;

use Bank\Account\CreditAccount;
use Bank\Services\Persistance\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\Persistance\ParseMethods;


class GetCreditAccount implements ControllerInterface
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
            $this->account = Database::GetEntityManager()->getRepository(CreditAccount::class)
                ->find($request->id);

            $methods = ParseMethods::getMethods(CreditAccount::class);
            $renderParams = array('object' => $this->account, 'methods' => $methods, 'dataType' => 'Credit Account', 'link' => 'account/credit/', 'mainData' => $this->account->getData());


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