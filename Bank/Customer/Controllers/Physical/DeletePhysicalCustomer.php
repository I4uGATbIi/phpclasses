<?php

namespace Bank\Customer\Controllers\Physical;



use Bank\Account\CreditAccount;
use Bank\Account\DepositAccount;
use Bank\Customer\PhysicalCustomer;
use Bank\Services\Persistance\NotFoundException;
use Bank\Services\ControllerInterface;
use Bank\Services\Database;



class DeletePhysicalCustomer implements ControllerInterface
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

            if(!$this->customer)
            {
                throw new NotFoundException();
            }
            if($this->customer->getAccounts()) {
                foreach ($this->customer->getAccounts() as $account) {
                    Database::GetEntityManager()->remove($account);
                }
            }
            Database::GetEntityManager()->remove($this->customer);
            Database::GetEntityManager()->flush();

            $html = <<<HTML
<form>
    <label>Customer Deleted</label>
	<button type="submit" formaction="/">Home</button>
</form>

HTML;

            return $html;

        } catch (NotFoundException $e) {
            return $response->redirect("/notfound");
        }
    }
}