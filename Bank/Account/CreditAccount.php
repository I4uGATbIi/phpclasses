<?php

namespace Bank\Account;

/**
 * Class CreditAccount
 * @package Bank\CreditAccount
 * @Entity @Table(name="CreditAccounts")
 */
class CreditAccount implements AccountInterface
{


    /**
     * @var integer
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;
    /**
     * @var integer
     * @Column(type="integer",nullable=true)
     */
    protected $customerId = null;
    /**
     * @var string
     * @Column(type="string")
     */
    protected $accountId;

    /**
     * @var double
     * @Column(type="float")
     */
    protected $balance;

    /**
     * @var double
     * @Column(type="float")
     */
    protected $creditLimit;

    /**
     * @var double
     * @Column(type="float")
     */
    protected $monthPercent;


    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return float
     */
    public function getCreditLimit()
    {
        return $this->creditLimit;
    }

    /**
     * @param float $creditLimit
     */
    public function setCreditLimit($creditLimit)
    {
        $this->creditLimit = $creditLimit;
    }

    /**
     * @return float
     */
    public function getMonthPercent()
    {
        return $this->monthPercent;
    }

    /**
     * @param float $monthPercent
     */
    public function setMonthPercent($monthPercent)
    {
        $this->monthPercent = $monthPercent;
    }


    public function getData()
    {
        return $this->getAccountId();
    }

    public function getType()
    {
        return 'credit';
    }




    function CheckForClosing()
    {
        return $this->balance>0;
    }
}