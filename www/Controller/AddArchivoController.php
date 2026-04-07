<?php

// CONTROLADOR AGREGAR ARCHIVO DE VISTA DetallesBien.php 
require_once("../DataBase/DbConfig.php");
require_once("../Model/BienModel.php");

$db = new MyDB;
$db->busyTimeout(5000);
$item = new BienModel;


$ultimoArchivos = $item->readUltimoArchivo();
$ultimoArchivo = $ultimoArchivos + 1;


//id del bien al que se le agragara el archivo
$bien = $_GET['id_bien'];



 // SI SE SUBE ARCHIVO 
if ($_FILES['archivos']['name'][0] !== "") {


    //POR CADA ARCHIVO
    foreach ($_FILES['archivos']['tmp_name']  as $key => $value) {


// SE MUEVE ARCHIVO A CARPETA /DOCUMENTOS
        move_uploaded_file($_FILES['archivos']['tmp_name'][$key], "../Documentos/" . $_FILES['archivos']['name'][$key]);
        $nombreA = $_FILES['archivos']['name'][$key];

 // PREGUNTA SI YA EXISTE EL ARCHIVO 
        $sql4 = "
      SELECT NOMBRE FROM ARCHIVO
       WHERE ARCHIVO.NOMBRE = '$nombreA';";

        $ret4 = $db->querySingle($sql4);

//SI NO EXISTE SE GUARDA EN LA REFERENCIA DEL ARCHIVO EN TABLA ARCHIVO
        if (empty($ret4)) {

            $sql2 = "
        INSERT INTO ARCHIVO (NOMBRE , DIRECCION)
        VALUES (  '$nombreA' , '../Documentos/'
         );";

            $ret2 = $db->exec($sql2);

  // SE RELACIONA EL ARCHIVO RECIEN INGRESADO  CON EL BIEN          
            $sql3 = "
      INSERT INTO BIEN_ARCHIVO (ID_BIEN , ID_ARCHIVO)
      VALUES ('$bien', '$ultimoArchivo');
     ";
            $ret3 = $db->exec($sql3);
            $ultimoArchivo = $ultimoArchivo + 1;


         //SI EL ARCHIVO EXISTE    
        } else {

        //SE BUSCA LA ID DEL ARCHIVO
            $sql6 = "
       SELECT ID_ARCHIVO FROM ARCHIVO
        WHERE ARCHIVO.NOMBRE = '$nombreA';";
            $ret6 = $db->querySingle($sql6);


            // SE RELACIONA EL ARCHIVO ECISTENTE CON EL BIEN RECIEN INGRESADO

            $sql5 = "
       INSERT INTO BIEN_ARCHIVO (ID_BIEN , ID_ARCHIVO)
       VALUES ('$bien' , '$ret6' );
       ";


            $ret5 = $db->exec($sql5);
        }
    }
}
$db->close();

?>




<html>

<!-- REDIRECCION A DetallesBien.php -->
<meta http-equiv="refresh" content="0;url=../View/DetallesBien.php?comuna=<?php echo "" . $_GET["comuna"] ?>&observacion=<?php echo "" . $_GET["observacion"] ?>&
                                                origen=<?php echo "" . $_GET["origen"] ?>&proveedor=<?php echo "" . $_GET["proveedor"] ?>&item_gasto=<?php echo "" . $_GET["item_gasto"] ?>&
                                                ubicacion=<?php echo "" . $_GET["ubicacion"] ?>&nombre=<?php echo "" . $_GET["nombre"] ?>&cantidad=<?php echo "" . $_GET["cantidad"] ?>
                                                &valor=<?php echo "" . $_GET["valor"] ?>&destino=<?php echo "" . $_GET["destino"] ?>&codigo=<?php echo "" . $_GET["codigo"] ?>
                                                &fecha_compra=<?php echo "" . $_GET["fecha_compra"] ?> &numero_factura=<?php echo "" . $_GET["numero_factura"] ?> 
                                                &id_bien=<?php echo "" . $_GET["id_bien"] ?>&fecha=<?php echo "" . $_GET["fecha"] ?>&buscar=<?php echo"". $_GET['buscar']?>&bien_cambio=<?php echo "" . $_GET["bien_cambio"] ?>  ">

</html>