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







    function CheckForClosing()
    {
        return $this->balance>0;
    }
}