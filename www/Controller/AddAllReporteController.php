<?php
// controlador inserta en la base de datos bienes a mostrar y exportar en pestaña externa cunado damos click al boton agregar todos de registros.php

require_once("../DataBase/DbConfig.php");


// variables get del boton  "AGREGAR TODOS" (<a>) 

$observacion = $_GET['observacion'];
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$comuna = $_GET['comuna'];
$origen = $_GET['origen'];
$proveedor = $_GET['proveedor'];
$item_gasto = $_GET['item_gasto'];
$ubicacion = $_GET['ubicacion'];
$buscar =  $_GET["buscar"];

//variable del boton <a> "agregar todos"
$reporte =  $_GET['reporte'];



$db = new MyDB;
$db->busyTimeout(5000);


// COSULTA PARA AGREGAR TODOS SIN FILTRO

$sql = "   SELECT *
FROM BIEN
INNER JOIN UBICACION
ON BIEN.ID_UBICACION = UBICACION.ID_UBICACION
INNER JOIN ITEM_GASTO
ON BIEN.ID_ITEM_GASTO = ITEM_GASTO.ID_ITEM_GASTO
INNER JOIN PROVEEDOR
ON BIEN.ID_PROVEEDOR = PROVEEDOR.ID_PROVEEDOR
INNER JOIN ORIGEN
ON BIEN.ID_ORIGEN = ORIGEN.ID_ORIGEN
INNER JOIN OBSERVACION
ON BIEN.ID_OBSERVACION = OBSERVACION.ID_OBSERVACION
INNER JOIN COMUNA
ON UBICACION.ID_COMUNA = COMUNA.ID_COMUNA
where COMUNA.ID_COMUNA= $comuna 
and OBSERVACION.ID_OBSERVACION = $observacion
and ORIGEN.ID_ORIGEN = $origen
and PROVEEDOR.ID_PROVEEDOR = $proveedor
and ITEM_GASTO.ID_ITEM_GASTO = $item_gasto
and UBICACION.ID_UBICACION = $ubicacion

ORDER BY COMUNA.COMUNA ASC , UBICACION.ID_UBICACION ASC , BIEN.CODIGO ASC
";

  // COSULTA PARA AGREGAR TODOS CON BUSQUEDA
if ($buscar != "nada") {

  
    $sql = "   SELECT *
    FROM BIEN
    INNER JOIN UBICACION
    ON BIEN.ID_UBICACION = UBICACION.ID_UBICACION
    INNER JOIN ITEM_GASTO
    ON BIEN.ID_ITEM_GASTO = ITEM_GASTO.ID_ITEM_GASTO
    INNER JOIN PROVEEDOR
    ON BIEN.ID_PROVEEDOR = PROVEEDOR.ID_PROVEEDOR
    INNER JOIN ORIGEN
    ON BIEN.ID_ORIGEN = ORIGEN.ID_ORIGEN
    INNER JOIN OBSERVACION
    ON BIEN.ID_OBSERVACION = OBSERVACION.ID_OBSERVACION
    INNER JOIN COMUNA
 ON UBICACION.ID_COMUNA = COMUNA.ID_COMUNA
    and BIEN.NOMBRE like '%$buscar%'
    OR BIEN.CODIGO = '$buscar'
ORDER BY COMUNA.COMUNA ASC , UBICACION.ID_UBICACION ASC , BIEN.CODIGO ASC
    ";

  
}



// COSULTA PARA AGREGAR TODOS CON FILTRO DE FECHA


if (isset($_GET['desde']) && $_GET['desde'] != ""  || isset($_GET['hasta']) && $_GET['hasta'] != "") {

    $sql = "   SELECT *
        FROM BIEN
        INNER JOIN UBICACION
        ON BIEN.ID_UBICACION = UBICACION.ID_UBICACION
        INNER JOIN ITEM_GASTO
        ON BIEN.ID_ITEM_GASTO = ITEM_GASTO.ID_ITEM_GASTO
        INNER JOIN PROVEEDOR
        ON BIEN.ID_PROVEEDOR = PROVEEDOR.ID_PROVEEDOR
        INNER JOIN ORIGEN
        ON BIEN.ID_ORIGEN = ORIGEN.ID_ORIGEN
        INNER JOIN OBSERVACION
        ON BIEN.ID_OBSERVACION = OBSERVACION.ID_OBSERVACION
        INNER JOIN COMUNA
        ON UBICACION.ID_COMUNA = COMUNA.ID_COMUNA
        where COMUNA.ID_COMUNA= $comuna 
        and OBSERVACION.ID_OBSERVACION = $observacion
        and ORIGEN.ID_ORIGEN = $origen
        and PROVEEDOR.ID_PROVEEDOR = $proveedor
        and ITEM_GASTO.ID_ITEM_GASTO = $item_gasto
        and UBICACION.ID_UBICACION = $ubicacion
        and BIEN.FECHA_COMPRA between  '$desde' and '$hasta'; 
ORDER BY COMUNA.COMUNA ASC , UBICACION.ID_UBICACION ASC , BIEN.CODIGO ASC
        ";
};


$now = DateTime::createFromFormat('U.u', microtime(true));
$id =  $now->format("m-d-Y H:i:s.u");

// SWITCH PARA VER A QUE TABLA SE AGREGAN TODOS LOS DATOS, VARIABLE  GET "reporte"  DE BOTON "AGREGAR TODOS"

switch ($reporte) {
    case 'oficina':

       


        $ret = $db->query($sql);
        $mas = 0;

 //INSERT TABLA OFICINA

        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
            $mas = $mas + 1;

            $sql2 = "   INSERT INTO OFICINA (ID, BIEN,CODIGO,CANTIDAD,OBSERVACION)
                 VALUES ( '$id$mas' , '$row[NOMBRE]' ,  '$row[CODIGO]',  '$row[CANTIDAD]' ,  '$row[OBSERVACION]'
                 );";

            $ret2 = $db->exec($sql2);
        }

        $db->close();
?>
        <script>
            history.back();
        </script> 

    <?php

        break;

    case 'robo':


        $ret = $db->query($sql);
        $mas = 0;

 //INSERT TABLA ROBO

        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
            $mas = $mas + 1;


            $sql2 = "   INSERT INTO ROBO (ID, BIEN,CANTIDAD,FACTURA ,RUT,PROVEEDOR, FECHA, MONTO_TOTAL)
  VALUES ( '$id$mas' , '$row[NOMBRE]' ,  '$row[CANTIDAD]',  '$row[NUMERO_FACTURA]',  '$row[RUT]' ,  '$row[NOMBRE_PROVEEDOR]' ,  '$row[FECHA_COMPRA]' ,  '$row[VALOR]'
   );";

            $ret2 = $db->exec($sql2);
        }

        $db->close();


    ?>
        <script>
            history.back();
        </script>

    <?php

        break;

    case 'baja':


        $ret = $db->query($sql);
        $mas = 0;

 //INSERT TABLA BAJA

        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
            $mas = $mas + 1;


            $sql2 = "   INSERT INTO BAJA (ID, BIEN,CANTIDAD,CODIGO )
      VALUES ( '$id$mas' , '$row[NOMBRE]' ,  '$row[CANTIDAD]',  '$row[CODIGO]'
       );";

            $ret2 = $db->exec($sql2);
        }
        $db->close();


    ?>
        <script>
            history.back();
        </script>

    <?php

        break;
    case 'incorporacion':


        $ret = $db->query($sql);
        $mas = 0;


 //INSERT TABLA INCORPORACION
        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
            $mas = $mas + 1;


            $sql2 = "   INSERT INTO INCORPORACION (ID, BIEN,CANTIDAD,UBICACION )
          VALUES ( '$id$mas' , '$row[NOMBRE]' ,  '$row[CANTIDAD]',  '$row[NOMBRE_UBICACION]'
           );";

            $ret2 = $db->exec($sql2);
        }
        $db->close();


    ?>
        <script>
            history.back();
        </script>

    <?php

        break;
    case 'todo_filtro':


        $ret = $db->query($sql);
        $mas = 0;

 //INSERT TABLA TODO_FILTRO

        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
            $mas = $mas + 1;


            $sql2 = "
                    INSERT INTO TODO_FILTRO (ID,UBICACION , BIEN,ITEM_GASTO , CODIGO ,NUMERO_FACTURA ,VALOR,FECHA_COMPRA,PROVEEDOR ,RUT,ORIGEN,CANTIDAD ,OBSERVACION, DESTINO , COMUNA  )
                    VALUES ('$id$mas', '$row[NOMBRE_UBICACION]', '$row[NOMBRE]' , '$row[ITEM_GASTO]', 
                    '$row[CODIGO]' , '$row[NUMERO_FACTURA]' ,'$row[VALOR]', '$row[FECHA_COMPRA]'
                    ,'$row[NOMBRE_PROVEEDOR]','$row[RUT]','$row[ORIGEN]','$row[CANTIDAD]',  '$row[OBSERVACION]' , '$row[DESTINO]' ,  '$row[COMUNA]' ); ";


            $ret2 = $db->exec($sql2);
        }
        $db->close();



    ?>
        <script>
            history.back();
        </script>

<?php

        break;


        

}
?>

