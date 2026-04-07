<?php
require_once("../DataBase/DbConfig.php");

$db = new MyDB;
$db->busyTimeout(5000);
$reporte = $_GET['reporte'];


$reportedel = strtoupper($reporte = $_GET['reporte']);

// BORRA TODO DEL LAS TABLAS DE REPORTES DEPENDIENDO DEL REPORTE (BOTON ELIMINAR TODOS DE VENTANA EMERGENTE SEGUN REPORTE)

    $sql = "DELETE from $reportedel ";
    $ret = $db->exec($sql);
    
    $db->close();

?>


   <html>
    <meta http-equiv="refresh" content="0;url=../View/Reportes.php?comuna=<?php echo"".$_GET['comuna']?>&observacion=<?php echo"".$_GET['observacion']?>&origen=<?php echo"".$_GET['origen']?>&proveedor=<?php echo"".$_GET['proveedor']?>&item_gasto=<?php echo"".$_GET['item_gasto']?>&ubicacion=<?php echo"".$_GET['ubicacion']?>&buscar=nada&reporte=<?php echo"".$_GET['reporte']?>">

    </html>
  
