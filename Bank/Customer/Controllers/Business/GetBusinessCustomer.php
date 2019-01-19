<?php

namespace Bank\Customer\Controllers\Business;

use Bank\Account\CreditAccount;
use Bank\Account\DepositAccount;
use Bank\Customer\BusinessCustomer;
use Bank\Services\Persistence\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;
use Bank\Services\DiContainer;
use Bank\Services\Persistence\ParseMethods;
use Twig\Environment;



class GetBusinessCustomer implements ControllerInterface
{
    /**
     * @var BusinessCustomer
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
     * @param BusinessCustomer $customer
     * @param \Katzgrau\KLogger\Logger $logger
     * @param Environment $twig
     */
    public function __construct(
        BusinessCustomer $customer,
        \Katzgrau\KLogger\Logger $logger,
        \Twig\Environment $twig
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
            $this->customer = Database::GetEntityManager()->getRepository(BusinessCustomer::class)
                ->find($request->id);
            $this->customer->setAccounts(Database::GetEntityManager()->getRepository(CreditAccount::class)
                ->findBy(array('customerId' => $this->customer->getId())));
            $this->customer->setAccounts(Database::GetEntityManager()->getRepository(DepositAccount::class)
                ->findBy(array('customerId' => $this->customer->getId())));
            $methods = ParseMethods::getMethods(BusinessCustomer::class);
            $renderParams= array( 'object'=>$this->customer , 'methods'=>$methods , 'dataType'=>'Business Customers' , 'link'=>'customer/business/','mainData'=>$this->customer->getData()
                ,'accounts' => $this->customer->getAccounts());
            if(!$this->customer)
            {
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