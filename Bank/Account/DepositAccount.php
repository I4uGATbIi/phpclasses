<?php

namespace Bank\Account;

/**
 * Class DepositAccount
 * @package Bank\DepositAccount
 * @Entity @Table(name="DepositAccounts")
 */
class DepositAccount implements AccountInterface
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

    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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

    public function getData()
    {
        return $this->getAccountId();
    }

    public function getType()
    {
        return 'deposit';
    }

    function CheckForClosing()
    {
        return $this->balance>0;
    }
}