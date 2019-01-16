<?php

namespace Bank\Account;

/**
 * Class Account
 * @package Bank\Account
 * @Entity @Table(name="Accounts")
 */
class Account implements AccountInterface
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
     * @var string
     * @Column (type="string")
     */
    protected $accType;

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
     * @return string
     */
    public function getAccType()
    {
        return $this->accType;
    }

    /**
     * @param string $accType
     */
    public function setAccType($accType)
    {
        $this->accType = $accType;
    }



    function CheckForClosing()
    {
        // TODO: Implement CheckForClosing() method.
    }
}