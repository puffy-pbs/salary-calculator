<?php

class ByCompletedWorkSalaryCalculator extends SalaryCalculator
{
    public function __construct(array $reports)
    {
        parent::__construct($reports);
    }

    /**
     * @desc get calculated result
     * @return array
     */
    public function get(): array
    {
        $employeeListIndexedByTask = $this->getEmployeeListIndexByName();
        $taskPaymentMap = $this->getTasksPaymentMap();
        return $this->calculate($employeeListIndexedByTask, $taskPaymentMap);
    }

    /**
     * @desc calculate the salaries for each employee
     * @param array $totalWorkByTask
     * @param array $taskPaymentMap
     * @return array
     */
    protected function calculate(array $totalWorkByTask, array $taskPaymentMap): array
    {
        $salariesByTask = [];
        foreach ($totalWorkByTask as $taskName => $employeeList) {
            $totalSalary = pos($taskPaymentMap[$taskName])->unitPrice;
            $this->ensureKeyExists($taskName, $salariesByTask, []);
            $totalWorkAll = $this->getTotalWorkForAll($employeeList);
            // unit price the employee should get for rating
            $unitPrice = $totalSalary / $totalWorkAll;
            foreach ($employeeList as $employeeName => $totalWork) {
                // the employee salary
                $salary = $unitPrice * $totalWork;
                $salariesByTask[$taskName][$employeeName] = round($salary, 2);
            }
        }

        return $salariesByTask;
    }
}
