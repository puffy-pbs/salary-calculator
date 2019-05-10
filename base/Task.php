<?php


class Task
{
    public $id;
    public $name;
    public $payment;
    public $unitPrice;
    public $coef;

    public function __construct(int $id, string $name, string $payment, float $unitPrice, array $coef)
    {
        $this->id = $id;
        $this->name = $name;
        $this->payment = $payment;
        $this->unitPrice = $unitPrice;
        $this->coef = $coef;
    }
}