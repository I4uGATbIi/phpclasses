<?php

namespace Bank\Customer;

/**
 * Class BussinessCustomer
 * @package Bank\Customer
 * @Entity @Table(name="businessCustomers")
 */
class BussinessCustomer implements CustomerInterface
{
    /**
     * @var string
     * @Column(type="string")
     */
    private $name;

    /**
     * @var integer
     * @Id @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @var string
     * @Column(type="string")
     */
    private $taxCode;


    /**
     * @var string
     * @Column(type="string")
     */
    private $pdvCode;

    /**
     * @var array
     */
    private $accounts;

    /**
     * @return string
     */
    public function getTaxCode()
    {
        return $this->taxCode;
    }

    /**
     * @param string $taxCode
     */
    public function setTaxCode($taxCode)
    {
        $this->taxCode = $taxCode;
    }

    /**
     * @return string
     */
    public function getPdvCode()
    {
        return $this->pdvCode;
    }

    /**
     * @param string $pdvCode
     */
    public function setPdvCode($pdvCode)
    {
        $this->pdvCode = $pdvCode;
    }



    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getData()
    {
        return $this->getName();
    }

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