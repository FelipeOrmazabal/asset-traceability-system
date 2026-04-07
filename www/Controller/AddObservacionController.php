<?php 
require_once("../DataBase/DbConfig.php");


$db = new MyDB;
$db->busyTimeout(5000);

$observacion = strtoupper($_POST['observacion']);



$sql =<<<EOF
INSERT INTO OBSERVACION (OBSERVACION)
VALUES ('$observacion'
 );

EOF;

 $ret = $db->exec($sql);

$db->close();



?>


<html> 
    
<meta http-equiv="refresh" content="0;url=../View/Administracion.php"> 
