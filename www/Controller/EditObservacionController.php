<?php
require_once("../DataBase/DbConfig.php");


$db = new MyDB;
$db->busyTimeout(5000);
$id_observacion = $_GET['id_observacion'];
$observacion = strtoupper($_POST['observacion']);


$sql = <<<EOF
UPDATE OBSERVACION set OBSERVACION  = "$observacion" 
where ID_OBSERVACION = $id_observacion ;
EOF;

$ret = $db->exec($sql);

$db->close();




?>
<html> 


<meta http-equiv="refresh" content="0;url=../View/Administracion.php">