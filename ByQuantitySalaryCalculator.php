<?php


class ByQuantitySalaryCalculator extends SalaryCalculator
{
    /**
     * @desc get calculated result
     * @return array
     */
    public function get(): array
    {
        $employeeListIndexedByTask = $this->getEmployeeListIndexByNameByDays();
        $taskPaymentMap = $this->getTasksPaymentMap();
        return $this->calculate($employeeListIndexedByTask, $taskPaymentMap);
    }

    /**
     * @desc calculate the salaries for each employee
     * @param array $totalWorkByTask
     * @return array
     */
    protected function calculate(array $totalWorkByTask, array $taskPaymentMap): array
    {
        $salariesByTask = [];
        foreach ($totalWorkByTask as $taskName => $tasks) {
            foreach ($tasks as $taskDate => $employeeList) {
                $taskPaymentObj = pos(array_filter($taskPaymentMap[$taskName], function ($taskPayment) use ($taskDate) {
                    return $taskDate === $taskPayment->date;
                }));
                $totalSalary = $taskPaymentObj->unitPrice * $taskPaymentObj->qty;
                $this->ensureKeyExists($taskName, $salariesByTask, []);
                $this->ensureKeyExists($taskDate, $salariesByTask[$taskName], []);
                $totalWorkAll = $this->getTotalWorkForAll($employeeList);
                // unit price the employee should get for rating
                $unitPrice = $totalSalary / $totalWorkAll;
                foreach ($employeeList as $employeeName => $totalWork) {
                    // the employee salary
                    $salary = $unitPrice * $totalWork;
                    $salariesByTask[$taskName][$taskDate][$employeeName] = round($salary, 2);
                }
            }
        }

        return $salariesByTask;
    }


}