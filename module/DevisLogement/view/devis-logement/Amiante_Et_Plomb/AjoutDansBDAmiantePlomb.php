<?php

require 'module/DevisLogement/view/devis-logement/logement/PHPExcel-1.8/Classes/PHPExcel.php';
header('Content-type: text/html; charset=utf-8');
global $conn;
$conn= pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=spartan") or die(pg_last_error());
pg_set_client_encoding($conn,"UTF-8");

function AjouterDataMaisonEtCitesDansBD($inputFileName,$file_name) //optimiser le programme car très long déjà pour une seule feuille, doit faire tous les feuilles à la suite !
{
    global $conn;
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);

    $sheetname = 'DATA';

    /**  Create a new Reader of the type defined in $inputFileType  **/
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);

    /**  Advise the Reader of which WorkSheets we want to load  **/
    $objReader->setLoadSheetsOnly($sheetname);

    /**  Load $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = $objReader->load($inputFileName);


    $colonneCourante = 0;
    $celluleCourante = 5;
    $tailleFeuille = (int)$objPHPExcel->getActiveSheet()->getHighestRow();
    for ($i = 0; $i < $tailleFeuille; $i++) {
        $NumArticleCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colonneCourante, $celluleCourante + $i)->getValue();
        $LibelleCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colonneCourante + 1, $celluleCourante + $i)->getValue();
        $UNCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colonneCourante + 3, $celluleCourante + $i)->getValue();
        $PUHTCourant =(float) $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colonneCourante + 4, $celluleCourante + $i)->getValue();


        $libelle = str_replace("'", " ", "$LibelleCourant");
        addslashes($libelle);
        if ($NumArticleCourant != null ) {
            $sql = "insert into datamaisonetcites (numeroarticle,libellearticle,un,puht) values ('$NumArticleCourant','$LibelleCourant','$UNCourant',NULLIF('$PUHTCourant','')::FLOAT )";

            pg_query($conn, $sql);

        }
    }
}

?>
