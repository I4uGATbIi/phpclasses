<?php

namespace Bank\Customer;

interface ICustomer
{
    function OpenAccountByType($accountType);
    function CloseAccount($accountId);
}