<?php


class TaskPayment
{
    public $date;
    public $unitPrice;
    public $qty;

    public function __construct(string $date, float $unitPrice, int $qty)
    {
        $this->date = $date;
        $this->unitPrice = $unitPrice;
        $this->qty = $qty;
    }
}