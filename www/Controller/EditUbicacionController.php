<?php
require_once("../DataBase/DbConfig.php");


$db = new MyDB;
$db->busyTimeout(200);
$id_ubicacion = $_GET['id_ubicacion'];
$ubicacion= strtoupper($_POST['ubicacion']);


$sql = <<<EOF
UPDATE UBICACION set NOMBRE_UBICACION  = "$ubicacion" 
where ID_UBICACION= $id_ubicacion ;
EOF;

$ret = $db->exec($sql);

$db->close();




?>
<html> 


<meta http-equiv="refresh" content="0;url=../View/Administracion.php"> 