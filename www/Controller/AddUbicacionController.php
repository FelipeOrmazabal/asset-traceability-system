<?php 
require_once("../DataBase/DbConfig.php");


$db = new MyDB;
$db->busyTimeout(5000);


$ubicacion = strtoupper($_POST['ubicacion']);
$comuna = strtoupper($_POST['comuna']);



$sql =<<<EOF
INSERT INTO UBICACION (NOMBRE_UBICACION, ID_COMUNA)
VALUES ('$ubicacion' , '$comuna'
 );

EOF;

 $ret = $db->exec($sql);

$db->close();



?>


 <html> 
    
<meta http-equiv="refresh" content="0;url=../View/Administracion.php">
