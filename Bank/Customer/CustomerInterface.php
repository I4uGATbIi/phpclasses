<?php

namespace Bank\Customer;

interface CustomerInterface
{
    function OpenDepositAccount();
    function OpenCreditAccount();
    function CloseAccount($accountId);
}