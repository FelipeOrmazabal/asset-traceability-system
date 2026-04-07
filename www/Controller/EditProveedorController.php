<?php
require_once("../DataBase/DbConfig.php");


$db = new MyDB;
$db->busyTimeout(200);
$id_proveedor = $_GET['id_proveedor'];
$proveedor = strtoupper($_POST['proveedor']);
$rut = strtoupper($_POST['rut']);


$sql = <<<EOF
UPDATE PROVEEDOR set NOMBRE_PROVEEDOR = "$proveedor" , RUT = "$rut"
where ID_PROVEEDOR= $id_proveedor ;
EOF;

$ret = $db->exec($sql);

$db->close();




?>
<html> 


<meta http-equiv="refresh" content="0;url=../View/Administracion.php">