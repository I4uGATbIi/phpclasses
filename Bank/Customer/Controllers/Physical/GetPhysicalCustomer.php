<?php

namespace Bank\Customer\Controllers\Physical;


use Bank\Account\AccountInterface;
use Bank\Account\CreditAccount;
use Bank\Account\DepositAccount;
use Bank\Customer\PhysicalCustomer;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\DiContainer;
use Twig\Environment;


class GetPhysicalCustomer implements ControllerInterface
{
    /**
     * @var PhysicalCustomer
     */
    private $customer;

    /**
     * @var \Katzgrau\KLogger\Logger
     */
    private $logger;

    /**
     * View constructor.
     * @param PhysicalCustomer $customer
     * @param \Katzgrau\KLogger\Logger $logger
     */
    public function __construct(
        PhysicalCustomer $customer,
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
            $this->customer = Database::GetEntityManager()->getRepository(PhysicalCustomer::class)
                ->find($request->id);
            $this->customer->setAccounts(Database::GetEntityManager()->getRepository(CreditAccount::class)
                ->findBy(array('customerId' => $this->customer->getId())));
            $this->customer->setAccounts(Database::GetEntityManager()->getRepository(DepositAccount::class)
                ->findBy(array('customerId' => $this->customer->getId())));
            if (!$this->customer) {
                throw new NotFoundException();

            }
            $arr = get_class_methods(PhysicalCustomer::class);
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

            //return print_r($this->customer->getAccounts());

            return $template->render(['object' => $this->customer, 'methods' => $methods, 'dataType' => 'Physical Customers',
                'link' => 'customer/physical/', 'mainData' => $this->customer->getData(),
                'accounts' => $this->customer->getAccounts()]);

        } catch (NotFoundException $e) {
            return $response->redirect("/notfound");
        }
    }
}