<?php 
require_once("../DataBase/DbConfig.php");


$db = new MyDB;
$db->busyTimeout(5000);

$origen = strtoupper($_POST['origen']);



$sql =<<<EOF
INSERT INTO ORIGEN (ORIGEN)
VALUES ('$origen'
 );

EOF;

 $ret = $db->exec($sql);

$db->close();



?>


<html> 
    
<meta http-equiv="refresh" content="0;url=../View/Administracion.php"> 
