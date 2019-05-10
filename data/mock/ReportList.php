<?php

abstract class ReportList implements IList
{
    protected $taskList;
    protected $employeeList;

    public function __construct(array $taskList)
    {
        $this->taskList = $taskList;
        $this->employeeList = (new EmployeeList())->get();
    }

    /**
     * @desc retrieve report list
     * @return array
     */
    abstract public function get(): array;
}