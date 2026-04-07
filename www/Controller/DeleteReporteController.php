<?php
require_once("../DataBase/DbConfig.php");
// CONTROLADOR ELIMINA BIENE EN LA BENTANA EMERGENTE DE REPORTE (BOTON ICONO"BASURERO")

$db = new MyDB;
$db->busyTimeout(5000);

$reporte = $_GET['reporte'];
$id = $_GET['id'];
$deleteall = $_GET['deleteall'];


if (isset($_GET['idp'])) {
    $idp =  $_GET['idp'] - 10;
}




$reportedel = strtoupper($reporte = $_GET['reporte']);



if ($deleteall == 1) {
    $sql = "DELETE from $reportedel ";
    $ret = $db->exec($sql);

    $db->close();

?>
   <html>
    <meta http-equiv="refresh" content="0;url=../ViewReporte/<?php echo "" . $_GET['reporte'] ?>.php?reporte=<?php echo "" . $_GET['reporte'] ?>&reload=1&recarga=adentro">

    </html> 
    <?php

} else {

    switch ($reporte) {
        case 'oficina':



            $sql = "DELETE from OFICINA where ID = '$id'";

            $ret = $db->exec($sql);

            $db->close();
    ?>
            <html>
            <meta http-equiv="refresh" content="0;url=../ViewReporte/oficina.php?reporte=<?php echo "" . $_GET['reporte'] ?>&reload=1&recarga=adentro&#la<?php echo "" . $idp ?>">

            </html>

        <?php
            break;
        case 'robo':


            $sql = "DELETE from ROBO where ID = '$id'";
            $ret = $db->exec($sql);

            $db->close();
        ?>

            <html>
            <meta http-equiv="refresh" content="0;url=../ViewReporte/robo.php?reporte=<?php echo "" . $_GET['reporte'] ?>&reload=1&recarga=adentro#la<?php echo "" . $idp  ?>">

            </html>

        <?php

            break;

        case 'baja':

            $sql = "DELETE from BAJA where ID = '$id'";
            $ret = $db->exec($sql);

            $db->close();
        ?>
            <html>
            <meta http-equiv="refresh" content="0;url=../ViewReporte/baja.php?reporte=<?php echo "" . $_GET['reporte'] ?>&reload=1&recarga=adentro#la<?php echo "" . $idp ?>">

            </html>
        <?php


            break;

        case 'incorporacion':
            $sql = "DELETE from INCORPORACION where ID = '$id'";
            $ret = $db->exec($sql);

            $db->close();
        ?>
            <html>
            <meta http-equiv="refresh" content="0;url=../ViewReporte/incorporacion.php?reporte=<?php echo "" . $_GET['reporte'] ?>&reload=1&recarga=adentro#la<?php echo "" . $idp  ?>">

            </html>
        <?php




            break;
        case 'todo_filtro':

            $sql = "DELETE from TODO_FILTRO where ID = '$id'";
            $ret = $db->exec($sql);

            $db->close();




        ?>
            <html>
            <meta http-equiv="refresh" content="0;url=../ViewReporte/todo_filtro.php?reporte=<?php echo "" . $_GET['reporte'] ?>&reload=1&recarga=adentro#la<?php echo "" . $idp  ?>">

            </html>
<?php break;
    }
} ?>