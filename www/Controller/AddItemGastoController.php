<?php 
require_once("../DataBase/DbConfig.php");


$db = new MyDB;
$db->busyTimeout(5000);

$item_gasto = strtoupper($_POST['item_gasto']);



$sql =<<<EOF
INSERT INTO ITEM_GASTO (ITEM_GASTO)
VALUES ('$item_gasto'
 );

EOF;

 $ret = $db->exec($sql);

$db->close();



?>



    
<meta http-equiv="refresh" content="0;url=../View/Administracion.php"> 

