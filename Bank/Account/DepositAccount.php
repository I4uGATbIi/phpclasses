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


    function CheckForClosing()
    {
        return $this->balance>0;
    }
}