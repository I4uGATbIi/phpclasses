<?php

namespace Bank\Customer;

use Bank\Account\AccountInterface;

/**
 * Class BusinessCustomer
 * @package Bank\Customer
 * @Entity @Table(name="physicalCustomers")
 */
class PhysicalCustomer implements CustomerInterface
{
    /**
     * @var integer
     * @Id @Column(type="integer") @GeneratedValue
     */
    private $id;
    /**
     * @var string
     * @Column(type="string")
     */
    private $firstName;
    /**
     * @var string
     * @Column(type="string")
     */
    private $lastName;
    /**
     * @var string
     * @Column(type="integer")
     */
    private $age;
    /**
     * @var string
     * @Column(type="string")
     */
    private $IPN;
    /**
     * @var string
     * @Column(type="string")
     */
    private $passportCode;

    /**
     * @var AccountInterface[]
     */
    private $accounts;


    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getIPN()
    {
        return $this->IPN;
    }

    /**
     * @param mixed $IPN
     */
    public function setIPN($IPN)
    {
        $this->IPN = $IPN;
    }

    /**
     * @return mixed
     */
    public function getPassportCode()
    {
        return $this->passportCode;
    }

    /**
     * @param mixed $passportCode
     */
    public function setPassportCode($passportCode)
    {
        $this->passportCode = $passportCode;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    public function getData()
    {
        return $this->getLastName().' '.$this->getFirstName();
    }

    /**
     * @return array
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param array $accounts
     */
    public function setAccounts($accounts)
    {
        foreach ($accounts as $account) {
            $this->accounts[] = $account;
        }
    }




    function OpenDepositAccount()
    {
        // TODO: Implement OpenDepositAccount() method.
    }

    function OpenCreditAccount()
    {
        // TODO: Implement OpenCreditAccount() method.
    }

    function CloseAccount($accountId)
    {
        // TODO: Implement CloseAccount() method.
    }
}