<?php
require_once("../DataBase/DbConfig.php");


$db = new MyDB;
$id_item_gasto = $_GET['id_item_gasto'];
$item_gasto= strtoupper($_POST['item_gasto']);


$sql = <<<EOF
UPDATE ITEM_GASTO set ITEM_GASTO  = "$item_gasto" 
where ID_ITEM_GASTO= $id_item_gasto ;
EOF;

$ret = $db->exec($sql);

$db->close();




?>
<html> 


<meta http-equiv="refresh" content="0;url=../View/Administracion.php"> 