<?php

namespace Bank\Services\Database;

use Bank\Services\Database;

use Bank\Services\ControllerInterface;

class MigrateController implements ControllerInterface
{
    public function execute($request, $response)
    {

        try {
            $em = Database::GetEntityManager();
            $tool = new \Doctrine\ORM\Tools\SchemaTool($em);
            $classes = array(
                $em->getClassMetadata('\Bank\Customer\BussinessCustomer'),
                $em->getClassMetadata('\Bank\Customer\PhysicalCustomer'),
                $em->getClassMetadata('\Bank\Account\DepositAccount'),
                $em->getClassMetadata('\Bank\Account\CreditAccount'),
            );
            $tool->createSchema($classes);
            return 'Schema created succesfully!';
        }
        catch (\Exception $e)
        {
            return $e->getMessage();

        }



    }
}