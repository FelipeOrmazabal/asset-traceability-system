<?php
require_once("../DataBase/DbConfig.php");

// CONTROLADOR PARA INGRESAR BIENES Y MOSTRAR EN VENTANA EMERGENTE DE REPORTES
$reporte = $_GET['reporte'];

$observacion = $_GET['observacion'];

// VARIABLES DEL BOTON ICONO " + " EN LA VISTA Reportes.php

$nombre =  $_GET['nombre'];
$codigo =  $_GET['codigo'];
$cantidad = $_GET['cantidad'];
$valor = $_GET['valor'];
$fecha_compra = $_GET['fecha_compra'];
$factura = $_GET['factura'];
$rut = $_GET['rut'];
$proveedor = $_GET['proveedor'];
$ubicacion = $_GET['ubicacion'];
$item_gasto = $_GET['item_gasto'];
$origen = $_GET['origen'];
$destino = $_GET['destino'];
$comuna = $_GET['comuna'];








$now = DateTime::createFromFormat('U.u', microtime(true));
$id =  $now->format("m-d-Y H:i:s.u");


//SWITCH  PARA VER EN QUE TABLA DE REPORTES SE INGRESA,   VARIABLES DEL BOTON ICONO " + " EN LA VISTA Reportes.php



switch ($reporte) {
    case 'oficina':


//SE IUNGRESA BINE EN TABLA OFICINA

        $db = new MyDB;
        $db->busyTimeout(5000);
        $sql = "   INSERT INTO OFICINA (ID, BIEN,CODIGO,CANTIDAD,OBSERVACION)
  VALUES ( '$id' , '$nombre' ,  '$codigo',  '$cantidad' ,  '$observacion'
   );";

        $ret = $db->exec($sql);
        $ret;
        $db->close();
       

?>

        <script>
            history.back();
        </script> 




    <?php
        break;
    case 'robo':


//SE IUNGRESA BINE EN TABLA ROBO

        $db = new MyDB;
        $db->busyTimeout(5000);
        $sql = "   INSERT INTO ROBO (ID, BIEN,CANTIDAD,FACTURA ,RUT,PROVEEDOR, FECHA, MONTO_TOTAL)
  VALUES ( '$id' , '$nombre' ,  '$cantidad',  '$factura' ,  '$rut',  '$proveedor' ,  '$fecha_compra' ,  '$valor'
   );";

        $ret = $db->exec($sql);
        $ret;
        $db->close();



    ?>
        <script>
            history.back();
        </script>
    <?php
        break;


    case 'baja':



        $db = new MyDB;
        $db->busyTimeout(5000);
        //SE IUNGRESA BINE EN TABLA BAJA

        $sql = "   INSERT INTO BAJA (ID, BIEN,CANTIDAD,CODIGO)
  VALUES ( '$id' , '$nombre' ,  '$cantidad',  '$codigo'
   );";

        $ret = $db->exec($sql);
        $ret;
        
        $db->close();



    ?>
        <script>
            history.back();
        </script>
    <?php
        break;

    case 'incorporacion':


        $db = new MyDB;
        $db->busyTimeout(5000);
        //SE IUNGRESA BINE EN TABLA INCORPORACION

        $sql = "   INSERT INTO INCORPORACION (ID, BIEN,CANTIDAD,UBICACION)
  VALUES ( '$id' , '$nombre' ,  '$cantidad',  '$ubicacion'
   );";

        $ret = $db->exec($sql);
        $ret;
        $db->close();



    ?>
        <script>
            history.back();
        </script>
    <?php


        break;
    case 'todo_filtro':
        $db = new MyDB;
        $db->busyTimeout(5000);
        //SE IUNGRESA BINE EN TABLA TODO_FILTRO


        $sql = "
            INSERT INTO TODO_FILTRO (ID,UBICACION , BIEN,ITEM_GASTO , CODIGO ,NUMERO_FACTURA ,VALOR,FECHA_COMPRA,PROVEEDOR ,RUT,ORIGEN,CANTIDAD ,OBSERVACION, DESTINO , COMUNA )
            VALUES ('$id', '$ubicacion', '$nombre' , '$item_gasto', 
            '$codigo' , '$factura' ,'$valor', '$fecha_compra'
            ,'$proveedor','$rut','$origen','$cantidad',  '$observacion' , '$destino' , '$comuna' ); ";


        $ret = $db->exec($sql);
        $ret;
      
        $db->close();

    ?>
        <script>
            history.back();
        </script>

<?php break;
}

?>