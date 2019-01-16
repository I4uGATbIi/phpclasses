<?php

namespace Bank\Customer;

/**
 * Class BussinessCustomer
 * @package Bank\Customer
 * @Entity @Table(name="businessCustomers")
 */
class BussinessCustomer implements ICustomer
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
     * @var array CommonAccount
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