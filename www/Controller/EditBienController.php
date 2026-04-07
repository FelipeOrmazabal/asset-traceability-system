<?php
require_once("../DataBase/DbConfig.php");
require_once("../Model/BienModel.php");

$db = new MyDB;
$item = new BienModel;
$ultimoArchivov = $item->readUltimoArchivo();
$ultimoBienv = $item->readUltimoBien();
$ultimoHistorial = $item->readUltimoHistorial();


// variables formulario
$id_bien = $_POST['id_bien'];
$codigo = strtoupper( str_replace(('"'),"''" , $_POST['codigo']));
$nombre = strtoupper( str_replace(('"'),"''" , $_POST['nombre']));
$cantidad = $_POST['cantidad'];
$valor = $_POST['valor'];
$ubicacion = $_POST['ubicacion'];
$item_gasto = $_POST['item_gasto'];
$proveedor = $_POST['proveedor'];
$origen = $_POST['origen'];
$observacion = $_POST['observacion'];
$destino = strtoupper( str_replace(('"'),"''" , $_POST['destino']));


$descripcion = strtoupper($_POST['descripcion']);
$numero_factura = $_POST['numero_factura'];
$fecha_compra = date("Y-m-d", strtotime($_POST['fecha_compra']));
$now = new DateTime();
$formattedDate = $now->format('Y-m-d');
$ultimoArchivo = $ultimoArchivov + 1;
$ultimoBien = $ultimoBienv + 1;
$ultimoHistorial = $ultimoHistorial + 1;
$cantidad_cambio = $_POST['cantidad_cambio'];
$bien_cambio = $_GET['bien_cambio'];


//variables bien actual

$codigoH = $_GET['codigoH'];
$nombreH = $_GET['nombreH'];
$ubicacionH = $_GET['ubicacionH'];
$item_gastoH = $_GET['item_gastoH'];
$origenH = $_GET['origenH'];
$observacionH = $_GET['observacionH'];
$comunaH = $_GET['comunaH'];
$proveedorH = $_GET['proveedorH'];
$destinoH = $_GET['destinoH'];






// if cambia todos los bienes o es solo 1
if ($cantidad == $cantidad_cambio || $cantidad_cambio == -1) {

  // guarda el cambio en historial 
  $sqlH = "
         INSERT INTO HISTORIAL (CODIGO,NOMBRE,CANTIDAD,VALOR,ID_UBICACION,ID_ITEM_GASTO,ID_PROVEEDOR,ID_ORIGEN,ID_OBSERVACION,DESTINO
          , DESCRIPCION , FECHA , BIEN_CAMBIO, NUMERO_FACTURA , FECHA_COMPRA)
         VALUES ('$codigo', '$nombre', '$cantidad', 
         '$valor' , '$ubicacion' ,'$item_gasto', '$proveedor'
         ,'$origen','$observacion','$destino','$descripcion', '$formattedDate', '$bien_cambio' , '$numero_factura' , '$fecha_compra' );";

  $ret = $db->exec($sqlH);


  // se actualizan los datos
  $sqlU = "
       UPDATE BIEN set CODIGO  = '$codigo' , NOMBRE = '$nombre' ,
       CANTIDAD= '$cantidad' , VALOR ='$valor' , ID_UBICACION= '$ubicacion',
       ID_ITEM_GASTO = '$item_gasto' , ID_ORIGEN = '$origen',  
       ID_OBSERVACION = '$observacion', DESTINO = '$destino'
       where ID_BIEN= '$id_bien'";

  $ret = $db->exec($sqlU);


  // se crea la relacion bien_historial
  $sqlBH = "
INSERT INTO BIEN_HISTORIAL (ID_BIEN , ID_HISTORIAL)
VALUES (  '$id_bien' , '$ultimoHistorial'
 );";




  $retBH = $db->exec($sqlBH);

  //si suben archivos 


  if ($_FILES['archivos']['name'][0] !== "") {


    //foreach por cada archivo 
    foreach ($_FILES['archivos']['tmp_name']  as $key => $value) {


      //se mueven los archivos a la carpeta documentos 
      move_uploaded_file($_FILES['archivos']['tmp_name'][$key], "../Documentos/" . $_FILES['archivos']['name'][$key]);
      // variable guarda nombre de los archivos 
      $nombreA = $_FILES['archivos']['name'][$key];

      //se busca si existe el archivo 
      $sql4 = "
              SELECT NOMBRE FROM ARCHIVO
               WHERE ARCHIVO.NOMBRE = '$nombreA';";

      $ret4 = $db->querySingle($sql4);

      // si la busqueda de archivos en la bd resulta vacia (no existe el archivo)
      if (empty($ret4)) {

        //se guardda el archivo en la bd
        $sql2 = "
                INSERT INTO ARCHIVO (NOMBRE , DIRECCION)
                VALUES (  '$nombreA' , '../Documentos/'
                 );";
        $ret2 = $db->exec($sql2);


        // se crea la relacion bien<->archivo en la tabla bien_archivo
        $sql3 = "
              INSERT INTO BIEN_ARCHIVO (ID_BIEN , ID_ARCHIVO)
              VALUES ('$id_bien', '$ultimoArchivo');
             ";


        $ret3 = $db->exec($sql3);

        // variable que indica el archivo que se subio(se le suma 1 para el siguiente archivo)
        $ultimoArchivo = $ultimoArchivo + 1;

        //si el archivo existe  
      } else {

        //se busca el id del archivo existente
        $sql6 = "
               SELECT ID_ARCHIVO FROM ARCHIVO
                WHERE ARCHIVO.NOMBRE = '$nombreA';";
        $ret6 = $db->querySingle($sql6);


        // se crea la relacion bien<-> archivo con el archivo existente
        $sql5 = "
               INSERT INTO BIEN_ARCHIVO (ID_BIEN , ID_ARCHIVO)
               VALUES ('$id_bien' , '$ret6' );
               ";


        $ret5 = $db->exec($sql5);
      }
    }
  }

  // si se cambian solo algunos de los bienes
} else {

  //cantidad de bienes que no se modifican 
  $cantidad_restante  = $cantidad - $cantidad_cambio;

  //valor que queda de los bienes que no se cambian 
  $valor_restante = ($valor / $cantidad) * $cantidad_restante;

  //valor  de los bienes que  se cambian 
  $valor_cambio = ($valor / $cantidad) * $cantidad_cambio;



  //se guardan en el historial los bienes que no cambian

  $sqlH = "
        INSERT INTO HISTORIAL (CODIGO,NOMBRE,CANTIDAD,VALOR,ID_UBICACION,ID_ITEM_GASTO,ID_PROVEEDOR,ID_ORIGEN,ID_OBSERVACION,DESTINO , DESCRIPCION , FECHA , BIEN_CAMBIO ,NUMERO_FACTURA , FECHA_COMPRA)
         VALUES ('$codigoH', '$nombreH', '$cantidad_restante', 
         '$valor_restante' , '$ubicacionH' ,'$item_gastoH', '$proveedorH'
        ,'$origenH','$observacionH','$destinoH','$descripcion', '$formattedDate' , 'CAMBIO' ,'$numero_factura' , '$fecha_compra' );";
  $retH = $db->exec($sqlH);

  // se actualiza los bienes que no se cambian ( cantidad y valor)
  $sqlU = "
       UPDATE BIEN set 
       CANTIDAD= '$cantidad_restante' , VALOR ='$valor_restante' 
       where ID_BIEN= '$id_bien'";
  $retU = $db->exec($sqlU);


  $sqlBHN = "
INSERT INTO BIEN_HISTORIAL (ID_BIEN , ID_HISTORIAL)
VALUES (  '$id_bien' , '$ultimoHistorial'
 );";


  $retBHN = $db->exec($sqlBHN);

  $ultimoHistorial = $ultimoHistorial + 1;



  //se guardan los bienes que cambian
  $sqlN = "
     INSERT INTO BIEN (CODIGO,NOMBRE,CANTIDAD,VALOR,ID_UBICACION,ID_ITEM_GASTO,ID_PROVEEDOR,ID_ORIGEN,ID_OBSERVACION,DESTINO , FECHA, BIEN_CAMBIO  ,NUMERO_FACTURA , FECHA_COMPRA)
     VALUES ('$codigo', '$nombre', '$cantidad_cambio', 
     '$valor_cambio' , '$ubicacion' ,'$item_gasto', '$proveedor'
     ,'$origen','$observacion','$destino', '$formattedDate' ,'CAMBIO' , '$numero_factura' , '$fecha_compra'); ";


  // se guarda un historial del bienes cambiados
  $retN = $db->exec($sqlN);
  $sqlNH = "
     INSERT INTO HISTORIAL (CODIGO,NOMBRE,CANTIDAD,VALOR,ID_UBICACION,ID_ITEM_GASTO,ID_PROVEEDOR,ID_ORIGEN,ID_OBSERVACION,DESTINO , DESCRIPCION , FECHA, BIEN_CAMBIO  ,NUMERO_FACTURA , FECHA_COMPRA)
     VALUES ('$codigo', '$nombre', '$cantidad_cambio', 
     '$valor_cambio' , '$ubicacion' ,'$item_gasto', '$proveedor'
     ,'$origen','$observacion','$destino','$descripcion', '$formattedDate', 'CAMBIO', '$numero_factura' , '$fecha_compra' );";

  // se buscan el historial relacionados al bien modifiado 
  $sqlBHNA = "
  SELECT * FROM BIEN_HISTORIAL
               WHERE BIEN_HISTORIAL.ID_BIEN = '$id_bien';";
  $retBHNA = $db->query($sqlBHNA);

  $cantidad = 0;
  while ($rowBHNA = $retBHNA->fetchArray(SQLITE3_ASSOC)) {

    $cantidad = $cantidad + 1;
  };

  // se buscan EL HISTORIAL del bien que no cambia y se agragan a los que cambiaron
  while ($rowBHNA = $retBHNA->fetchArray(SQLITE3_ASSOC)) {
    $cantidad = $cantidad - 1;

    if ($cantidad !== 0) {

      $sqlBHNA = "
    INSERT INTO BIEN_HISTORIAL (ID_BIEN , ID_HISTORIAL)
    VALUES ( '$ultimoBien' , '$rowBHNA[ID_HISTORIAL]');";


      $retB = $db->exec($sqlBHNA);
    }
  }


  $retNH = $db->exec($sqlNH);


  $sqlBHC = "
  INSERT INTO BIEN_HISTORIAL (ID_BIEN , ID_HISTORIAL)
  VALUES (  '$ultimoBien' , '$ultimoHistorial'
   );";


  $retBHC = $db->exec($sqlBHC);






  // se buscan los archivos relacionados al bien modifiado 
  $sqlA = "
   SELECT * FROM BIEN_ARCHIVO
                WHERE BIEN_ARCHIVO.ID_BIEN = '$id_bien';";
  $retA = $db->query($sqlA);

  // se buscan los archivos del bien que no cambia y se agragan a los que cambiaron
  while ($rowA = $retA->fetchArray(SQLITE3_ASSOC)) {

    $sqlBA  = "
     INSERT INTO BIEN_ARCHIVO (ID_BIEN , ID_ARCHIVO)
     VALUES (  '$ultimoBien' , '$rowA[ID_ARCHIVO]'
      );";


    $retB = $db->exec($sqlBA);
  }





  //si suben archivos 
  if ($_FILES['archivos']['name'][0] !== "") {


    //por cada archivo subido
    foreach ($_FILES['archivos']['tmp_name']  as $key => $value) {


      //se mueven los archivos a la carpeta documentos 
      move_uploaded_file($_FILES['archivos']['tmp_name'][$key], "../Documentos/" . $_FILES['archivos']['name'][$key]);

      //variable guarda el nombre de los archivos 
      $nombreA = $_FILES['archivos']['name'][$key];

      //se busca si existe el archivo  
      $sql4 = "
              SELECT NOMBRE FROM ARCHIVO
               WHERE ARCHIVO.NOMBRE = '$nombreA';";
      $ret4 = $db->querySingle($sql4);

      //si no existe
      if (empty($ret4)) {

        //se guarda el archivo en la bd
        $sql2 = "
                INSERT INTO ARCHIVO (NOMBRE , DIRECCION)
                VALUES (  '$nombreA' , '../Documentos/'
                 );";

        $ret2 = $db->exec($sql2);


        // se crea la relacion bien<->archivo  con le bien modificado
        $sql3 = "
              INSERT INTO BIEN_ARCHIVO (ID_BIEN , ID_ARCHIVO)
              VALUES ('$ultimoBien', '$ultimoArchivo');
             ";
        $ret3 = $db->exec($sql3);

        // variable que indica el archivo que se subio(se le suma 1 para el siguiente archivo)
        $ultimoArchivo = $ultimoArchivo + 1;
        //si existe
      } else {

        //se busca id del archivo existente
        $sql6 = "
               SELECT ID_ARCHIVO FROM ARCHIVO
                WHERE ARCHIVO.NOMBRE = '$nombreA';";
        $ret6 = $db->querySingle($sql6);


        // se crea la relacion bien<->archivo con el archivo existente
        $sql5 = "
               INSERT INTO BIEN_ARCHIVO (ID_BIEN , ID_ARCHIVO)
               VALUES ('$ultimoBien' , '$ret6' );
               ";

        $ret5 = $db->exec($sql5);
      }
    }
  }
}










$db->close();



?>
<!--  REDIRECCIONA A LA VISTA CON LOS PARAMTROS QUE NECESITA -->


 <meta http-equiv="refresh" content="0;url=../View/Bien.php?comuna=<?php echo "" . $_GET["comuna"]?>&observacion=<?php echo "" . $_GET["observacion"]?>&origen=<?php echo "" . $_GET["origen"]?>&proveedor=<?php echo "" . $_GET["proveedor"]?>&item_gasto=<?php echo "" . $_GET["item_gasto"]?>&ubicacion=<?php echo "" . $_GET["ubicacion"]?>&buscar=<?php echo "" . $_GET['buscar']?>&comunahead=<?php echo  "" . $_GET['comunahead']?>&comunatodos=<?php echo "" . $_GET['comunatodos']?>&limit=<?php echo "" . $limitenum?>">   