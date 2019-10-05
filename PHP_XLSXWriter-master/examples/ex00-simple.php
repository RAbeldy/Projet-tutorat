<?php
set_include_path( get_include_path().PATH_SEPARATOR."..");
//include_once("xlsxwriter.class.php");

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

$filename = "Exportfgfdgdfgfg.xlsx";
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

$header = array(
    'year'=>'string',
    'month'=>'string',
    'amount'=>'string',
    'first_event'=>'string',
    'second_event'=>'string',
    'Nombre de tuteur'=>'string',
    'Nomvre de place'=>'string',
);
$data1 = [];

    foreach($donnees as $data)
    { 
	    $data1 [] = array($data['tutorat'],$data['evenement']->getDate_evenement(),$data['evenement']->getLieu(),$data['evenement']->getNb_places_tutores(),$data['evenement']->getNb_tuteurs(),$data['evenement']->getNb_places(),$data['planning_event']);
    }
/*$data1 = array(
    array('2003','1','-50.5','2010-01-01','2012-12-31'),
    array('2003','=B2', '23.5','2010-01-01','2012-12-31'),
    array('2003',"'=B2", '23.5','2010-01-01','2012-12-31'),
);*/
var_dump($data1);
$writer = new XLSXWriter();
$writer->writeSheetHeader('Sheet1', $header);
foreach($data1 as $row){
	$writer->writeSheetRow('Sheet1', $row);
}
$writer->writeToFile($filename);
//$writer->writeToStdOut();
//$writer->tempFilename();
//$writer->writeToString();


