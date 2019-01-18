<?php

namespace Bank\Account\Controllers\Deposit;

use Bank\Account\DepositAccount;
use Bank\Account\AccountInterface;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\DiContainer;
use Twig\Environment;

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
            $this->account = Database::GetEntityManager()->getRepository(DepositAccount::class)
                ->find($request->id);
            if(!$this->account)
            {
                throw new NotFoundException();
            }
            $arr=get_class_methods(DepositAccount::class);
            foreach ($arr as $method_name) {
                if(strpos($method_name,'get')===0) {
                    $methods[] = $method_name;
                }
            }

            $twig = DiContainer::getInstance()->get(Environment::class);
            $template = $twig->load('CustomerOrAccount.html');
            return $template->render([ 'object'=>$this->account , 'methods'=>$methods,'dataType'=>'Deposit Account' , 'link'=>'account/deposit/','mainData'=>$this->account->getData()]);

        } catch (NotFoundException $e) {
            return $response->redirect("/notfound");
        }
    }
}