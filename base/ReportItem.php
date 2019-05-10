<?php

class ReportItem
{
    public $employee;
    public $reportedTime;
    public $rating;

    public function __construct(Employee $employee, int $reportedTime, int $rating)
    {
        $this->employee = $employee;
        $this->reportedTime = $reportedTime;
        $this->rating = $rating;
    }
}