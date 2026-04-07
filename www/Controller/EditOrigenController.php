<?php
require_once("../DataBase/DbConfig.php");


$db = new MyDB;
$db->busyTimeout(5000);
$id_origen = $_GET['id_origen'];
$origen= strtoupper($_POST['origen']);


$sql = <<<EOF
UPDATE ORIGEN set ORIGEN  = "$origen" 
where ID_ORIGEN= $id_origen ;
EOF;

$ret = $db->exec($sql);

$db->close();




?>
<html> 


<meta http-equiv="refresh" content="0;url=../View/Administracion.php"> 