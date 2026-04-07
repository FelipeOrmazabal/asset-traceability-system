<?php


$desde = "";
$hasta = "";

if ($_POST["desde"] != "") {

    $desde =   $newDate = date("Y-m-d", strtotime($_POST['desde']));;
}
if ($_POST["hasta"] !=""){

    $hasta =   $newDate = date("Y-m-d", strtotime($_POST['hasta']));;
}



// REDIRECCIONA CON LOS PARAMETROS DEL FILTRO A LA PAGINA Bien.php
if ($_GET["pagina"] == "bienes") { ?>

     <meta http-equiv="refresh" content="0;url=../View/Bien.php?comuna=<?php echo "" . $_GET["comuna"]?>&observacion=<?php echo "" . $_POST["observacion"]?>&origen=<?php echo "" . $_POST["origen"]?>&proveedor=<?php echo "" . $_POST["proveedor"]?>&item_gasto=<?php echo "" . $_POST["item_gasto"]?>&ubicacion=<?php echo "" . $_POST["ubicacion"]?>&buscar=nada&desde=<?php echo "" . $desde?>&hasta=<?php echo "" . $hasta?>&comunahead=<?php echo  "" . $_GET['comunahead']?>&comunatodos=<?php echo "" . $_GET['comunatodos']?>&limit=<?php $_GET['limit']?>"> 
<?php } else {
    // REDIRECCIONA CON LOS PARAMETROS DEL FILTRO A LA PAGINA Reportes.php ?>

    <html>
    <meta http-equiv="refresh" content="0;url=../View/Reportes.php?comuna=<?php echo "" . $_POST["comuna"]?>&observacion=<?php echo "" . $_POST["observacion"]?>&origen=<?php echo "" . $_POST["origen"]?>&proveedor=<?php echo "" . $_POST["proveedor"]?>&item_gasto=<?php echo "" . $_POST["item_gasto"]?>&ubicacion=<?php echo "" . $_POST["ubicacion"]?>&buscar=nada&reporte=<?php echo "" . $_GET["reporte"]?>&desde=<?php echo "" . $desde?>&hasta=<?php echo "" . $hasta?>&limit=<?php $_GET['limit']?>">
    </html>


<?php }


?>