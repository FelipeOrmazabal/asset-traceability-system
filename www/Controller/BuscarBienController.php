


<?php


// REDIRECCIONA CON EL PARAMETRO DE BUSQUEDA A LA VISTA Bienes.php
if ($_GET["pagina"] == "bienes") { ?>


<html>
<meta http-equiv="refresh" content="0;url=../View/Bien.php?comuna=<?php echo "" . $_GET["comuna"]?>&observacion=<?php echo "" . $_GET["observacion"]?>&origen=<?php echo "" . $_GET["origen"]?>&proveedor=<?php echo "" . $_GET["proveedor"]?>&item_gasto=<?php echo "" . $_GET["item_gasto"]?>&ubicacion=<?php echo "" . $_GET["ubicacion"]?>&buscar=<?php  echo"".strtoupper($_POST["buscar"])?>&limit=<?php $_GET['limit']?>&comunahead=<?php echo  "" . $_GET['comunahead']?>&comunatodos=<?php echo "" . $_GET['comunatodos']?>">

</html> 



<?php } else { 
    // REDIRECCIONA CON EL PARAMETRO DE BUSQUEDA A LA VISTA Reportes.php
    ?>

    <html>

<meta http-equiv="refresh" content="0;url=../View/Reportes.php?comuna=<?php echo "" . $_GET["comuna"]?>&observacion=<?php echo "" . $_GET["observacion"]?>&origen=<?php echo "" . $_GET["origen"]?>&proveedor=<?php echo "" . $_GET["proveedor"]?>&item_gasto=<?php echo "" . $_GET["item_gasto"]?>&ubicacion=<?php echo "" . $_GET["ubicacion"]?>&buscar=<?php echo"".strtoupper($_POST["buscar"])?>&reporte=<?php echo "" . $_GET["reporte"]?>&limit=<?php $_GET['limit']?>">

</html> 


<?php }


?>