<?php
ini_set("display_errors",0);error_reporting(0);

global  $conn;
$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=admin") or die(pg_last_error());
pg_set_client_encoding($conn,"UTF-8");
$designation = $_POST['designation'];
$un = $_POST['un'];
$puht = (float)$_POST['puht'];
$codemetc = (int)$_POST['codemetc'];
$numordre = (string)$_POST['numordre'];
$numerodossier = (string)$_POST['numerodossier'];
$annee = (string)$_POST['annee'];
str_replace("\r\n", "", [$designation, $un]);

$designation2 = substr($designation,0, strlen($designation) -1);
$un2 = substr($un,0, strlen($un) -1);

$sql= "update masterdispatching set
	 		designation='$designation2',un='$un2',puht=$puht
        where (codemetc=$codemetc)";

$result = pg_query($conn, $sql);
$error = pg_last_error();
echo $error;
if (!$result) {
    echo "Une erreur s'est produite.\n";
    exit;
}
?>