<?php

namespace Bank\Customer;

interface ICustomer
{
    function OpenDepositAccount();
    function OpenCreditAccount();
    function CloseAccount($accountId);
}