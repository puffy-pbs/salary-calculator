<?php


class ReportListByPaymentTypeQuantity extends ReportList
{

    public function __construct()
    {
        parent::__construct((new TaskListByPaymentTypeQuantity())->get());
    }

    /**
     * @desc retrieve report list
     * @return array
     */
    public function get(): array
    {
        return [
            new Report('2019-04-10', 13, [
                new ReportItem($this->employeeList[3], 8, 3),
                new ReportItem($this->employeeList[1], 5, 3),
                new ReportItem($this->employeeList[2], 5, 1)
            ], $this->taskList['TaskSecond']),
            new Report('2019-04-10', 5, [
                new ReportItem($this->employeeList[4], 8, 3),
            ], $this->taskList['TaskFourth']),
            new Report('2019-04-12', 10, [
                new ReportItem($this->employeeList[1], 4, 3),
                new ReportItem($this->employeeList[0], 5, 3),
                new ReportItem($this->employeeList[2], 4, 5),
                new ReportItem($this->employeeList[3], 6, 3),
            ], $this->taskList['TaskSecond']),
            new Report('2019-04-12', 5, [
                new ReportItem($this->employeeList[0], 3, 1),
                new ReportItem($this->employeeList[4], 8, 3),
                new ReportItem($this->employeeList[1], 4, 5),
            ], $this->taskList['TaskFourth']),
        ];
    }
}