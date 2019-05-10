<?php

class TaskListByPaymentTypeQuantity extends TaskList
{
    /**
     * @desc retrieve report list
     * @return array
     */
    public function get(): array
    {
        return [
            'TaskSecond' => new Task(2, 'Task #2', PaymentType::QUANTITY, 60, [
                    Type::SENIOR => 1.2,
                    Type::MID => 1.2,
                    Type::JUNIOR => 1
                ]
            ),
            'TaskFourth' => new Task(4, 'Task #4', PaymentType::QUANTITY, 30, [
                    Type::SENIOR => 1.3,
                    Type::MID => 1.3,
                    Type::JUNIOR => 1
                ]
            ),
        ];
    }
}