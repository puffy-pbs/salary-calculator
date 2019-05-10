<?php

abstract class SalaryCalculator
{
    protected $employeeLists;
    protected $reports;

    public function __construct(array $reports)
    {
        $this->reports = $reports;
    }

    /**
     * @desc calculate the salaries for each employee
     * @param array $totalWorkByTask
     * @return array
     */
    abstract protected function calculate(array $totalWorkByTask, array $taskPaymentMap): array;

    /**
     * @desc get calculated result
     * @return array
     */
    abstract public function get(): array;

    /**
     * @desc retrieve employees by name
     * @return array
     */
    protected function getEmployeeListIndexByName(): array
    {
        $employeeListIndexedByName = [];
        foreach ($this->reports as $report) {
            foreach ($report->reportItems as $reportItem) {
                $employee = $reportItem->employee;
                $task = $report->task;
                $this->ensureKeyExists($task->name, $employeeListIndexedByName, []);
                $this->ensureKeyExists($employee->name, $employeeListIndexedByName[$task->name], 0);
                $valuesToAdd = [$reportItem->rating, $task->coef[$employee->type]];
                if ($task->payment === PaymentType::COMPLETION_OF_TASK) {
                    $valuesToAdd[] = $reportItem->reportedTime;
                }
                $employeeListIndexedByName[$task->name][$employee->name] += array_product($valuesToAdd);
            }
        }

        return $employeeListIndexedByName;
    }

    /**
     * @desc retrieve employees by name
     * @return array
     */
    protected function getEmployeeListIndexByNameByDays(): array
    {
        $employeeListIndexedByName = [];
        foreach ($this->reports as $report) {
            foreach ($report->reportItems as $reportItem) {
                $employee = $reportItem->employee;
                $task = $report->task;
                $this->ensureKeyExists($task->name, $employeeListIndexedByName, []);
                $this->ensureKeyExists($report->date, $employeeListIndexedByName[$task->name], []);
                $this->ensureKeyExists($employee->name, $employeeListIndexedByName[$task->name][$report->date], 0);
                $valuesToAdd = [$reportItem->rating, $task->coef[$employee->type]];
                $employeeListIndexedByName[$task->name][$report->date][$employee->name] += array_product($valuesToAdd);
            }
        }

        return $employeeListIndexedByName;
    }

    protected function getTasksPaymentMap(): array
    {
        $tasksPaymentMap = [];
        foreach ($this->reports as $report) {
            $task = $report->task;
            $this->ensureKeyExists($task->name, $tasksPaymentMap, []);
            $tasksPaymentMap[$task->name][] = new TaskPayment($report->date, $task->unitPrice, $report->jobQuantity);
        }

        return $tasksPaymentMap;
    }

    /**
     * @desc retrieve the sum of completed job for all employees
     * @param array $totalWorkByEmployees
     * @return float
     */
    protected function getTotalWorkForAll(array $totalWorkByEmployees): float
    {
        $totalWorkAll = array_reduce($totalWorkByEmployees, function ($carry, $val) {
            $carry += is_numeric($val) ? $val : array_sum($val);
            return $carry;
        }, 0);
        return $totalWorkAll;
    }

    /**
     * @desc ensure key exists or if not set the key
     * @param string $key
     * @param array $arr
     * @param $val
     */
    protected function ensureKeyExists(string $key, array &$arr, $val): void
    {
        if (!array_key_exists($key, $arr)) {
            $arr[$key] = $val;
        }
    }
}