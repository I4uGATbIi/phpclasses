<?php

namespace Bank\Account\Controllers\Credit;

use Bank\Account\CreditAccount;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\DiContainer;
use Twig\Environment;


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
                ->find($request->id);
            if(!$this->account)
            {
                throw new NotFoundException();
            }
            $arr=get_class_methods(CreditAccount::class);
            foreach ($arr as $method_name) {
                if(strpos($method_name,'get')===0) {
                    $methods[] = $method_name;
                }
            }

            $twig = DiContainer::getInstance()->get(Environment::class);
            $template = $twig->load('CustomerOrAccount.html');
            return $template->render([ 'object'=>$this->account , 'methods'=>$methods,'dataType'=>'Credit Account' , 'link'=>'account/credit/','mainData'=>$this->account->getData()]);

        } catch (NotFoundException $e) {
            return $response->redirect("/notfound");
        }
    }
}