<?php

require_once('./autoload.php');

try {
    $byQtyCalc = SalaryCalculatorProducer::create((new ReportListByPaymentTypeQuantity())->get());
    $byCmpCalc = SalaryCalculatorProducer::create((new ReportListByPaymentTypeCompletion())->get());
    echo('Calculation by Quantity' . PHP_EOL);
    print_r($byQtyCalc->get());
    echo('Calculation by Completion Of Task' . PHP_EOL);
    print_r($byCmpCalc->get());
} catch (Exception $e) {
    var_dump($e->getMessage());
}

