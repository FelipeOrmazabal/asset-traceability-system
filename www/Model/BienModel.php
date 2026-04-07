<?php

require_once("../DataBase/DbConfig.php");





class BienModel
{


  public function readAll($comuna, $observacion, $origen, $proveedor, $item_gasto, $ubicacion ,$limit )
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
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
ORDER BY COMUNA.COMUNA ASC , UBICACION.ID_UBICACION ASC , BIEN.CODIGO ASC limit $limit
";

    $ret = $db->query($sql);
    return  $ret;

    $db->close();
  }




  public function readFecha($comuna, $observacion, $origen, $proveedor, $item_gasto, $ubicacion , $desde , $hasta ,$limit )
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
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
and BIEN.FECHA_COMPRA between  '$desde' and '$hasta' 
ORDER BY COMUNA.COMUNA ASC , UBICACION.ID_UBICACION ASC , BIEN.CODIGO ASC limit $limit; 

";

    $ret = $db->query($sql);
    return  $ret;
    $db->close();
  }



  
  public function readBuscar( $buscar ,$limit )
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
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
where  BIEN.NOMBRE like '%$buscar%'
OR BIEN.CODIGO =  '$buscar'
ORDER BY COMUNA.COMUNA ASC , UBICACION.ID_UBICACION ASC , BIEN.CODIGO ASC limit $limit
";

    $ret = $db->query($sql);
    return  $ret;
    $db->close();
  }



  public function readArchivo($id)
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = "SELECT * FROM BIEN_ARCHIVO INNER JOIN ARCHIVO ON BIEN_ARCHIVO.ID_ARCHIVO = 
ARCHIVO.ID_ARCHIVO WHERE BIEN_ARCHIVO.ID_BIEN = $id"; 

    $ret = $db->query($sql);
    return  $ret;
    $db->close();
  }
  public function readUbicacionComuna($id)
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = <<<EOF
  SELECT *
FROM UBICACION where ID_COMUNA = $id ORDER BY ID_COMUNA ASC
  ; 
EOF;
    $ret = $db->query($sql);
    return  $ret;
    $db->close();
  }
  public function readUbicacion()
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = <<<EOF
  SELECT *
FROM UBICACION  ORDER by ID_COMUNA 
  ; 
EOF;
    $ret = $db->query($sql);
    return  $ret;
    $db->close();
  }
  public function readItem_gasto()
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = <<<EOF
  SELECT *
FROM ITEM_GASTO 
  ; 
EOF;
    $ret = $db->query($sql);
    return  $ret;
    $db->close();
  }

  public function readProveedor()
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = <<<EOF
  SELECT *
FROM PROVEEDOR ORDER BY NOMBRE_PROVEEDOR ASC
  ; 
EOF;
    $ret = $db->query($sql);
    return  $ret;
    $db->close();
  }

  public function readOrigen()
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = <<<EOF
  SELECT *
FROM Origen 
  ; 
EOF;
    $ret = $db->query($sql);
    return  $ret;
    $db->close();
  }

  public function readObservacion()
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = <<<EOF
  SELECT *
FROM OBSERVACION 
  ; 
EOF;
    $ret = $db->query($sql);
    return  $ret;
    $db->close();
  }


  public function readComuna()
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = <<<EOF
  SELECT *
FROM COMUNA 
  ; 
EOF;
    $ret = $db->query($sql);
    return  $ret;
    $db->close();
  }


  public function readUltimoBien()
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = <<<EOF
SELECT ID_BIEN
FROM BIEN
ORDER BY ID_BIEN
DESC LIMIT 1
  ; 
EOF;

    $ret = $db->querySingle($sql);


    if (empty($ret)) {
      return 0;
    } else {

      return $ret;
    }
    $db->close();
  }

  public function readUltimoArchivo()
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = <<<EOF
SELECT ID_ARCHIVO
FROM ARCHIVO
ORDER BY ID_ARCHIVO
DESC LIMIT 1
  ; 
EOF;
    $ret = $db->querySingle($sql);
    if (empty($ret)) {

      return 0;
    } else {
      return  $ret;
    }

    $db->close();
  }


  public function readUltimoHistorial()
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = <<<EOF
SELECT ID_HISTORIAL
FROM HISTORIAL
ORDER BY ID_HISTORIAL
DESC LIMIT 1
  ; 
EOF;
    $ret = $db->querySingle($sql);
    if (empty($ret)) {

      return 0;
    } else {
      return  $ret;
    }

    $db->close();
  }


  public function  readOficina()
  {
      $db = new MyDB;
      $db->busyTimeout(5000);
      $sql = " SELECT * 
FROM OFICINA; ";

      $ret = $db->query($sql);
      return  $ret;
      $db->close();
  }
  public function cantidadReadAll($comuna, $observacion, $origen, $proveedor, $item_gasto, $ubicacion  )
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = "    SELECT COUNT (ID_BIEN)
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


";

    $ret = $db->querySingle($sql);
    return  $ret;

    $db->close();
  }
 
  public function cantidadReadFecha($comuna, $observacion, $origen, $proveedor, $item_gasto, $ubicacion , $desde , $hasta  )
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = "   SELECT COUNT (ID_BIEN)
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

";

    $ret = $db->querySingle($sql);
    return  $ret;
    $db->close();
  }
  public function cantidadReadBuscar( $buscar )
  {
    $db = new MyDB;
    $db->busyTimeout(5000);
    $sql = "    SELECT COUNT (ID_BIEN)
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
where  BIEN.NOMBRE like '%$buscar%'
OR BIEN.CODIGO = '$buscar'
ORDER BY COMUNA.COMUNA ASC , UBICACION.ID_UBICACION ASC , BIEN.CODIGO ASC 
";

    $ret = $db->querySingle($sql);
    return  $ret;
    $db->close();
  }

}
