<?php

namespace Bank\Customer;

class BussinessCustomer implements ICustomer
{
    /**
     * @var string
     * @field
     * @size 128
     */
    private $name;
    /**
     * @var integer
     * @field
     * @primary
     */
    private $id;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



}