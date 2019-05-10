<?php

class EmployeeList implements IList
{
    /**
     * @desc retrieve employee list
     * @return array
     */
    public function get(): array
    {
        $employeeList = [
            new Employee(1, 'Employee 1', Type::SENIOR),
            new Employee(2, 'Employee 2', Type::MID),
            new Employee(3, 'Employee 3', Type::JUNIOR),
            new Employee(4,  'Employee 4', Type::JUNIOR),
            new Employee(5, 'Employee 5', Type::JUNIOR)
        ];

        return $employeeList;
    }
}