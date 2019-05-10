<?php

class SalaryCalculatorProducer
{
    /**
     * @desc create new instance
     * @param array $reports
     * @return SalaryCalculator
     */
    public static function create(array $reports): SalaryCalculator
    {
        if (count(self::checkForSame($reports)) <> 1) {
            throw new LogicException('Use only reports which are of tasks with equal payment types!');
        }

        switch (pos($reports)->task->payment) {
            case PaymentType::COMPLETION_OF_TASK:
                return new ByCompletedWorkSalaryCalculator($reports);
            case PaymentType::QUANTITY:
                return new ByQuantitySalaryCalculator($reports);
            default:
                throw new InvalidArgumentException('Unknown Payment Type');
        }
    }

    /**
     * @desc ensure tasks are of the same payment type
     * @param array $reports
     * @return array
     */
    private static function checkForSame(array $reports): array
    {
        $isCheckTask = array_reduce($reports, function ($carry, $report) {
            $task = $report->task;
            if (!array_key_exists($task->payment, $carry)) {
                $carry[$task->payment] = 0;
            }
            $carry[$task->payment]++;
            return $carry;
        }, []);

        return $isCheckTask;
    }

}