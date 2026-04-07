<?php
require_once("../DataBase/DbConfig.php");


$db = new MyDB;
$id_comuna = $_GET['id_comuna'];
$comuna=  strtoupper($_POST['comuna']);


$sql = <<<EOF
UPDATE COMUNA set COMUNA  = "$comuna" 
where ID_COMUNA= $id_comuna ;
EOF;

$ret = $db->exec($sql);

$db->close();




?>
<html> 


<meta http-equiv="refresh" content="0;url=../View/Administracion.php"> 