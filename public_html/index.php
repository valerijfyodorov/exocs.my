<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;


$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("input.xls");
require '1.php';

$now = new DateTime("now");

for ($i = 2; $i <= 2736; $i++) {
    $cellValue = $spreadsheet->getActiveSheet()->getCellByColumnAndRow(7, $i)->getValue();
    //echo $cellValue.'<br>';

    if (in_array_r($cellValue,$arr)){
        //echo 'есть отчет     ';
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(8, $i, 'Есть отчет');

        $date = DateTime::createFromFormat("Y-m-d H:i:s",$arr[$i]['lastdate']);
        $interval = $now->diff($date);
        //echo $interval->format('%R%a дней'),'<br>';
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(9, $i, $interval->format('%R%a дней'));

    }
}
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('output.xls');

echo 'Готово!!!!!';