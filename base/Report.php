<?php


class Report
{
    public $reportItems;
    public $date;
    public $task;
    public $jobQuantity;

    public function __construct(string $date, int $jobQuantity, array $reports, Task $task)
    {
        $this->date = $date;
        $this->jobQuantity = $jobQuantity;
        $this->reportItems = $reports;
        $this->task = $task;
    }
}