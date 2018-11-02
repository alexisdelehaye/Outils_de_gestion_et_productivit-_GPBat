<?php

	$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres ")  or die(pg_last_error());


include '../../../../../public/PHPExcel-1.8/Classes/PHPExcel.php';

$inputFileType = 'Excel5';
$inputFileName = './DEVIS TCE-AHI-RELL V 6.4-2_février 2018.xlsm';
$sheetname = 'DEVIS TCE';

/**  Create a new Reader of the type defined in $inputFileType  **/
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
/**  Advise the Reader of which WorkSheets we want to load  **/
$objReader->setLoadSheetsOnly($sheetname);
/**  Load $inputFileName to a PHPExcel Object  **/
$objPHPExcel = $objReader->load($inputFileName);

print $objPHPExcel->getActiveSheet()->getCell('A1')->getValue();


?>