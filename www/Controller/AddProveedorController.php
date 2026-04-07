<?php 
require_once("../DataBase/DbConfig.php");


$db = new MyDB;
$db->busyTimeout(5000);

$proveedor = strtoupper($_POST['proveedor']);
$rut = strtoupper($_POST['rut']);



$sql ="
INSERT INTO PROVEEDOR ( NOMBRE_PROVEEDOR , RUT)
VALUES ('$proveedor' , '$rut'
 )";


 $ret = $db->exec($sql);

$db->close();



?>


 <html> 
    
<meta http-equiv="refresh" content="0;url=../View/Administracion.php">   
