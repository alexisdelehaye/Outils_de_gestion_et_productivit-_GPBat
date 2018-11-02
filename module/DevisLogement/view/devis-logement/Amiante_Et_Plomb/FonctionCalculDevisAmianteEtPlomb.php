<?php


ini_set("display_errors",0);error_reporting(0);

global  $conn;
$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=spartan") or die(pg_last_error());



function nombreDeRéfparTableBDD()