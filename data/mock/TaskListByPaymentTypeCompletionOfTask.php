<?php


class TaskListByPaymentTypeCompletionOfTask extends TaskList
{
    /**
     * @desc retrieve report list
     * @return array
     */
    public function get(): array
    {
        return [
            'TaskFirst' => new Task(1, 'Task #1', PaymentType::COMPLETION_OF_TASK, 1300, [
                    Type::SENIOR => 1.3,
                    Type::MID => 1.2,
                    Type::JUNIOR => 1
                ]
            ),
            'TaskThird' => new Task(3, 'Task #3', PaymentType::COMPLETION_OF_TASK, 800, [
                    Type::SENIOR => 1.5,
                    Type::MID => 1.3,
                    Type::JUNIOR => 1.2
                ]
            ),
        ];
    }
}