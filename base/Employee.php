<?php

class Employee
{
    public $id;
    public $name;
    public $type;

    public function __construct(int $id, string $name, float $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }
}