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
use Bank\Services\Persistence\ParseMethods;

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
     * @var \Twig\Environment
     */
    private $twig;

    /**
     * View constructor.
     * @param PhysicalCustomer $customer
     * @param \Katzgrau\KLogger\Logger $logger
     * @param \Twig\Environment $twig
     *
     */
    public function __construct(
        PhysicalCustomer $customer,
        \Katzgrau\KLogger\Logger $logger
        ,\Twig\Environment $twig

    )
    {
        $this->customer = $customer;
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
            $this->customer = Database::GetEntityManager()->getRepository(PhysicalCustomer::class)
                ->find($request->id);
            $this->customer->setAccounts(Database::GetEntityManager()->getRepository(CreditAccount::class)
                ->findBy(array('customerId' => $this->customer->getId())));
            $this->customer->setAccounts(Database::GetEntityManager()->getRepository(DepositAccount::class)
                ->findBy(array('customerId' => $this->customer->getId())));
            $methods = ParseMethods::getMethods(PhysicalCustomer::class);
            $renderParams = array('object' => $this->customer, 'methods' => $methods, 'dataType' => 'Physical Customers',
                'link' => 'customer/physical/', 'mainData' => $this->customer->getData(),
                'accounts' => $this->customer->getAccounts());
            if (!$this->customer) {
                throw new NotFoundException();

            }



            $template = $this->twig->load('CustomerOrAccount.html');


            return $template->render($renderParams);

        } catch (NotFoundException $e) {
            $template=$this->twig->load('noresults.html');
            return  $template->render($renderParams);
        }
    }
}