<?php


require('PHPExcel.php');
// Load an existing spreadsheet
$phpExcel = PHPExcel_IOFactory::load('products.xlsx');
// Get the first sheet
$sheet = $phpExcel ->getActiveSheet();
// Remove 2 rows starting from the row 2
$sheet ->removeRow(2,2);
// Insert one new row before row 2
$sheet->insertNewRowBefore(2, 1);
// Create the PHPExcel spreadsheet writer object
// We will create xlsx file (Excel 2007 and above)
$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
// Save the spreadsheet
$writer->save('products.xlsx');


?>