<?php
 

 //controlador para ingresar un bien 

require_once("../DataBase/DbConfig.php");
require_once("../Model/BienModel.php");
$item = new BienModel;
$ultimoArchivo = $item->readUltimoArchivo();
$ultimoBien = $item->readUltimoBien();
$ultimoHistorial = $item->readUltimoHistorial();

$db = new MyDB;
$db->busyTimeout(5000);

 
// VARIABLERS POST DEL FORMULARIO
$codigo = strtoupper( str_replace(('"'),"''" , $_POST['codigo']));
$nombre = strtoupper( str_replace(('"'),"''" , $_POST['nombre']));
$cantidad = $_POST['cantidad'];
$valor = $_POST['valor'];
$ubicacion = $_POST['ubicacion'];
$item_gasto = $_POST['item_gasto'];
$proveedor =$_POST['proveedor'];
$origen = $_POST['origen'];
$observacion = $_POST['observacion'];
$destino = strtoupper( str_replace(('"'),"''" , $_POST['destino']));
$factura = $_POST['factura'];
$fecha_compra = date("Y-m-d", strtotime($_POST['fecha_compra']));



$now = new DateTime();
$formattedDate = $now->format('Y-m-d');


// ID DEL ULTIMO BIEN ARCHIVO E HISTORIAL  PARA RELACIONARLOS 
$ultimoArchivo = $ultimoArchivo + 1;
$ultimoBien = $ultimoBien + 1;
$ultimoHistorial = $ultimoHistorial+1;



// INERTAR BIEN EN TABLA BIEN
 $sql = "
   INSERT INTO BIEN (CODIGO,NOMBRE,CANTIDAD,VALOR,ID_UBICACION,ID_ITEM_GASTO,ID_PROVEEDOR,ID_ORIGEN,ID_OBSERVACION,DESTINO , NUMERO_FACTURA , FECHA , BIEN_CAMBIO, FECHA_COMPRA )
   VALUES ('$codigo', '$nombre', '$cantidad', 
   '$valor' , '$ubicacion' ,'$item_gasto', '$proveedor'
   ,'$origen','$observacion','$destino',  '$factura' , '$formattedDate', 'NO CAMBIO' , '$fecha_compra' ); ";


   // INERTAR BIEN EN TABLA HISTORIAL
 $ret = $db->exec($sql);
 $sqlA = "
   INSERT INTO HISTORIAL (CODIGO,NOMBRE,CANTIDAD,VALOR,ID_UBICACION,ID_ITEM_GASTO,ID_PROVEEDOR,ID_ORIGEN,ID_OBSERVACION,DESTINO , DESCRIPCION , FECHA,BIEN_CAMBIO, FECHA_COMPRA, NUMERO_FACTURA )
   VALUES ('$codigo', '$nombre', '$cantidad', 
   '$valor' , '$ubicacion' ,'$item_gasto', '$proveedor'
   ,'$origen','$observacion','$destino','PRIMER INGRESO', '$formattedDate', 'NO CAMBIO' , '$fecha_compra' , '$factura' );";


 $retA = $db->exec($sqlA);


 // SE RELACIONA LE BIEN RECIEN INGRESADO CON EL HITORIAL RECIEN INGRESADO
 $sqlBH = "
 INSERT INTO BIEN_HISTORIAL (ID_BIEN , ID_HISTORIAL)
 VALUES (  '$ultimoBien' , '$ultimoHistorial'
  );";


 $retBH = $db->exec($sqlBH);




// SI AL INGRESAR SE SUBE ARCHIVO

 if ($_FILES['archivos']['name'][0] !== "") {



   foreach ($_FILES['archivos']['tmp_name']  as $key => $value) {


    // SE MUEVE EL ARCHIVO A LA CARPETA /DOCUMENTOS
     move_uploaded_file($_FILES['archivos']['tmp_name'][$key], "../Documentos/" . $_FILES['archivos']['name'][$key]);
     $nombreA = $_FILES['archivos']['name'][$key];


// CONSULTA PARA SABER SI EL ARCHIVO YA EXISTE 
     $sql4 = "
      SELECT NOMBRE FROM ARCHIVO
       WHERE ARCHIVO.NOMBRE = '$nombreA';";

     $ret4 = $db->querySingle($sql4);


     // SI NO EXISTE SE  INGRESA REFERENCIA A LA TABLA ARCHIVO
     if (empty($ret4)) {
       $sql2 = "
        INSERT INTO ARCHIVO (NOMBRE , DIRECCION)
        VALUES (  '$nombreA' , '../Documentos/'
         );";


       $ret2 = $db->exec($sql2);

      // SE RELACIONA EL ARCHIVO RECIEN INGRSADO CON EL BIEN RECIEN INGRESADO 
       $sql3 = "
      INSERT INTO BIEN_ARCHIVO (ID_BIEN , ID_ARCHIVO)
      VALUES ('$ultimoBien', '$ultimoArchivo');
     ";


       $ret3 = $db->exec($sql3);
       $ultimoArchivo = $ultimoArchivo + 1;

       // SI EXISTE 
     } else {

      //SE BUSCA EL ID DEL ARCHIVO RECIEN INGRESADO
       $sql6 = "
       SELECT ID_ARCHIVO FROM ARCHIVO
        WHERE ARCHIVO.NOMBRE = '$nombreA';";
       $ret6 = $db->querySingle($sql6);

//SE RELACIONA CON EL ARCHIVO EXISTENTE CON BIEN RECIEN INGRSADO

       $sql5 = "
       INSERT INTO BIEN_ARCHIVO (ID_BIEN , ID_ARCHIVO)
       VALUES ('$ultimoBien' , '$ret6' );
       ";


       $ret5 = $db->exec($sql5);
     }
   }
 }
 $db->close();

 ?>


 <meta http-equiv="refresh" content="0;url=../View/Bien.php?comuna=<?php echo "" . $_GET["comuna"]?>&observacion=<?php echo "" . $_GET["observacion"]?>&origen=<?php echo "" . $_GET["origen"]?>&proveedor=<?php echo "" . $_GET["proveedor"]?>&item_gasto=<?php echo "" . $_GET["item_gasto"]?>&ubicacion=<?php echo "" . $_POST["ubicacion"]?>&buscar=nada&ultimo=ultimo&comunahead=<?php echo  "" . $_GET['comunahead']?>&comunatodos=<?php echo "" . $_GET['comunatodos']?>&limit=<?php echo "" . $limitenum?>">
  
