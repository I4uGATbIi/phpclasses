<?php

namespace Bank\Customer\Controllers\Business;

use Bank\Account\CreditAccount;
use Bank\Account\DepositAccount;
use Bank\Customer\BussinessCustomer;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\DiContainer;
use Twig\Environment;



class GetBusinessCustomer implements ControllerInterface
{
    /**
     * @var BussinessCustomer
     */
    private $customer;

    /**
     * @var \Katzgrau\KLogger\Logger
     */
    private $logger;

    /**
     * View constructor.
     * @param BussinessCustomer $product
     * @param \Katzgrau\KLogger\Logger $logger
     */
    public function __construct(
        BussinessCustomer $customer,
        \Katzgrau\KLogger\Logger $logger
    )
    {
        $this->customer = $customer;
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
            $this->customer = Database::GetEntityManager()->getRepository(BussinessCustomer::class)
                ->find($request->id);
            $this->customer->setAccounts(Database::GetEntityManager()->getRepository(CreditAccount::class)
                ->findBy(array('customerId' => $this->customer->getId())));
            $this->customer->setAccounts(Database::GetEntityManager()->getRepository(DepositAccount::class)
                ->findBy(array('customerId' => $this->customer->getId())));
            if(!$this->customer)
            {
                throw new NotFoundException();
            }

            $arr=get_class_methods(BussinessCustomer::class);
            foreach ($arr as $method_name) {
                if (strpos($method_name, 'get') === 0) {
                    if (!strpos($method_name, 'Acc')) {
                        if (!strpos($method_name, 'Id')) {
                            if (!strpos($method_name, 'Name')) {
                                $methods[] = $method_name;
                            }
                        }
                    }
                }
            }

            $twig = DiContainer::getInstance()->get(Environment::class);
            $template = $twig->load('CustomerOrAccount.html');
            return $template->render([ 'object'=>$this->customer , 'methods'=>$methods , 'dataType'=>'Business Customers' , 'link'=>'customer/business/','mainData'=>$this->customer->getData()]);

        } catch (NotFoundException $e) {
            return $response->redirect("/notfound");
        }
    }
}