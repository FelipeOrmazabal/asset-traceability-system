<?php 
require_once("../DataBase/DbConfig.php");


$db = new MyDB;
$db->busyTimeout(5000);

$comuna = strtoupper($_POST['comuna']);

//SE INGRESA COMUNA A LA TABLA COMUNA

$sql =<<<EOF
INSERT INTO COMUNA (COMUNA)
VALUES ('$comuna'
 );

EOF;

 $ret = $db->exec($sql);

$db->close();



?>



 <html> 
    
<meta http-equiv="refresh" content="0;url=../View/Administracion.php">  