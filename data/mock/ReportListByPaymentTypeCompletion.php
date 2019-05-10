<?php


class ReportListByPaymentTypeCompletion extends ReportList
{
    public function __construct()
    {
        parent::__construct((new TaskListByPaymentTypeCompletionOfTask())->get());
    }

    /**
     * @desc retrieve report list
     * @return array
     */
    public function get(): array
    {
        return [
            'ReportFirst' => new Report('2019-04-10', 10, [
                new ReportItem($this->employeeList[0], 4, 3),
                new ReportItem($this->employeeList[1], 3, 3),
                new ReportItem($this->employeeList[2], 3, 3)
            ], $this->taskList['TaskFirst']),
            'ReportSecond' => new Report('2019-04-11', 12, [
                new ReportItem($this->employeeList[2], 5, 3),
                new ReportItem($this->employeeList[3], 5, 1),
            ], $this->taskList['TaskFirst']),
            'ReportThird' => new Report('2019-04-11', 8, [
                new ReportItem($this->employeeList[4], 2, 5),
                new ReportItem($this->employeeList[0], 6, 1),
            ], $this->taskList['TaskThird'])
        ];
    }
}