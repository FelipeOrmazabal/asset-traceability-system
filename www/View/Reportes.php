<?php



require_once("../Model/BienModel.php");
require_once("../DataBase/DbConfig.php");


$item = new BienModel;

$ubicacion = $item->readUbicacion();
$item_gasto = $item->readItem_gasto();
$proveedor = $item->readProveedor();
$origen = $item->readOrigen();
$observacion = $item->readObservacion();
$comuna = $item->readComuna();
$archivo = $item->readArchivo("0");




if ($page = "reporte") {
    $idfiltro = 'ID_COMUNA';
}

$desde = "";
$hasta = "";
$page = "reporte";

if (isset($_GET['desde']) && $_GET['desde'] != "" && isset($_GET['hasta']) && $_GET['hasta'] != "") {



    $desde = $_GET['desde'];
    $hasta = $_GET['hasta'];
}
if (isset($_GET['desde']) && $_GET['desde'] != "" && isset($_GET['hasta']) && $_GET['hasta'] == "") {

    $now = new DateTime();
    $formattedDate = $now->format('Y-m-d');
    $desde = $_GET['desde'];
    $hasta = $formattedDate;
}
if (isset($_GET['desde']) && $_GET['desde'] == "" && isset($_GET['hasta']) && $_GET['hasta'] != "") {

    $now = new DateTime();
    $desde = "1980-01-01";
    $hasta = $_GET['hasta'];
}

if (isset($_GET['limit'])) {

    $limitenum =  intval($_GET['limit']);

    $limitenum = $limitenum + 50;
} else {
    $limitenum = "50";
}



$Allitem = $item->readAll($_GET["comuna"], $_GET["observacion"], $_GET["origen"], $_GET["proveedor"], $_GET["item_gasto"], $_GET["ubicacion"], $limitenum);
$cantidadBienes = $item->cantidadReadAll($_GET["comuna"], $_GET["observacion"], $_GET["origen"], $_GET["proveedor"], $_GET["item_gasto"], $_GET["ubicacion"]);


if ($_GET['buscar'] != "nada") {

  $Allitem = $item->readBuscar($_GET['buscar'], $limitenum);
  $cantidadBienes = $item->cantidadReadBuscar($_GET['buscar']);


}

if (isset($_GET['desde']) && $_GET['desde'] != ""  || isset($_GET['hasta']) && $_GET['hasta'] != "") {


  $Allitem = $item->readFecha($_GET["comuna"], $_GET["observacion"], $_GET["origen"], $_GET["proveedor"], $_GET["item_gasto"], $_GET["ubicacion"],  $desde, $hasta , $limitenum);
  $cantidadBienes = $item->cantidadReadFecha($_GET["comuna"], $_GET["observacion"], $_GET["origen"], $_GET["proveedor"], $_GET["item_gasto"], $_GET["ubicacion"],  $desde, $hasta );
}



$ubicacionFiltro = $item->readUbicacionComuna($idfiltro);
$reporte = $_GET['reporte'];
$buscar = $_GET['buscar'];









?>






<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <!-- Bootstrap CSS -->


    <link rel="stylesheet" href="../bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap-4.6.2-dist/css/bootstrap.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css">
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/messages/messages.es-es.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="../bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
    <title>Inventario Oficina</title>
    <?php include("Modules/header.php") ?>
</head>



<body>
    
  <div id="cargando"  style="  background-color: white; z-index: 1000; height: 100%; width: 100%; position: fixed;   " role="status">

<div style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"  class="spinner-border text-primary  " role="status">
    <span   class="sr-only">Loading...</span>
  </div>
</div>



    <div style="padding-bottom: 20px; padding-top: 20px; " class="form-row col d-flex justify-content-between align-items-center ">
        <div style="padding-left: 21px;" class="col row">
            <div class="dropdown  ">
                <button style="background-color: #0000ff; color: white"  class="btn  dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    Tipo de reporte
                </button>
                <div class="dropdown-menu">

                    <a id="btnOficina" href="../Controller/DeleteAllReporteController.php?comuna=<?php echo"".$_GET['comuna']?>&observacion=<?php echo"".$_GET['observacion']?>&origen=<?php echo"".$_GET['origen']?>&proveedor=<?php echo"".$_GET['proveedor']?>&item_gasto=<?php echo"".$_GET['item_gasto']?>&ubicacion=<?php echo"".$_GET['ubicacion']?>&buscar=nada&reporte=oficina" class="dropdown-item"> Inventario por ubicacion</a>



                    <a id="btnRobo" class="dropdown-item"  href="../Controller/DeleteAllReporteController.php?comuna=<?php echo"".$_GET['comuna']?>&observacion=<?php echo"".$_GET['observacion']?>&origen=<?php echo"".$_GET['origen']?>&proveedor=<?php echo"".$_GET['proveedor']?>&item_gasto=<?php echo"".$_GET['item_gasto']?>&ubicacion=<?php echo"".$_GET['ubicacion']?>&buscar=nada&reporte=robo">Informe de robo </a>


                    <a id="btnBaja" class="dropdown-item" href="../Controller/DeleteAllReporteController.php?comuna=COMUNA.ID_COMUNA&observacion=OBSERVACION.ID_OBSERVACION&origen=ORIGEN.ID_ORIGEN&proveedor=PROVEEDOR.ID_PROVEEDOR&item_gasto=ITEM_GASTO.ID_ITEM_GASTO&ubicacion=UBICACION.ID_UBICACION&buscar=nada&reporte=baja">Informe de baja / donacion </a>



                    <a id="btnIncorporacion" class="dropdown-item"  href="../Controller/DeleteAllReporteController.php?comuna=<?php echo"".$_GET['comuna']?>&observacion=<?php echo"".$_GET['observacion']?>&origen=<?php echo"".$_GET['origen']?>&proveedor=<?php echo"".$_GET['proveedor']?>&item_gasto=<?php echo"".$_GET['item_gasto']?>&ubicacion=<?php echo"".$_GET['ubicacion']?>&buscar=nada&reporte=incorporacion">Incorporacion de activos </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../ViewReporte/todo.php">Exportar todo </a>
                    <a id="btnFiltro" class="dropdown-item"  href="../Controller/DeleteAllReporteController.php?comuna=<?php echo"".$_GET['comuna']?>&observacion=<?php echo"".$_GET['observacion']?>&origen=<?php echo"".$_GET['origen']?>&proveedor=<?php echo"".$_GET['proveedor']?>&item_gasto=<?php echo"".$_GET['item_gasto']?>&ubicacion=<?php echo"".$_GET['ubicacion']?>&buscar=nada&reporte=todo_filtro">Exportar con filtro </a>

                </div>

            </div>
            <div class="col mt-1"><label for="">
                    <?php

                    switch ($reporte) {
                        case 'no seleccionado':
                            echo "no seleccionado";
                            break;
                        case 'oficina':
                            echo "Inventario por ubicacion";
                            break;
                        case 'robo':
                            echo "Informe de robo";
                            break;
                        case 'baja':
                            echo "Informe de baja / donacion";
                            break;
                        case 'incorporacion':
                            echo "incorporacion de activos";
                            break;
                        case 'todo_filtro':
                            echo "Exportar con filtro";
                            break;
                    }


                    ?>


                </label></div>

        </div>
        <div style="padding-right: 300px; " class="col row">

            <form method="post" class="form-inline" action="../Controller/BuscarBienController.php?comuna=<?php echo "" . $_GET["comuna"]?>&observacion=<?php echo "" . $_GET["observacion"]?>&origen=<?php echo "" . $_GET["origen"]?>&proveedor=<?php echo "" . $_GET["proveedor"]?>&item_gasto=<?php echo "" . $_GET["item_gasto"]?>&ubicacion=<?php echo "" . $_GET["ubicacion"]?>&buscar=<?php echo "" . $buscar?>&pagina=reportes&reporte=<?php echo "" . $_GET['reporte']?>">
                <input style="width: 300px;" required name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar: Codigo/Nombre" aria-label="Buscar">
                <button style="background-color: #0000ff; color: white"  class="btn " type="submit">Buscar</button>
            </form>
        </div>


        <div class="" id="headingTwo">
            <label> </label>
            <p>

            </p>
        </div>
    </div>

    <div class="col">



        <?php
        if ($reporte != "no seleccionado") {
            include("Modules/Filtro.php");
        }
        ?>


        <div class="">


            <table class=" table table-sm  ">


                <thead style="background-color: #ff0000;">
                    <tr>
                        <th style="color: white;" scope="col">UBICACION</th>
                        <th style="color: white;" scope="col">BIEN</th>
                        <th style="color: white;" scope="col">ITEM GASTO</th>
                        <th style="color: white;" scope="col ">CODIGO</th>
                        <th style="color: white;" scope="col">N° FACTURA</th>
                        <th style="color: white;" scope="col">VALOR</th>
                        <th style="color: white;" scope="col">PROVEEDOR</th>
                        <th style="color: white;" scope="col">ORIGEN</th>
                        <th style="color: white;" scope="col">CANTIDAD</th>
                        <th style="color: white;" scope="col">OBSERVACION</th>
                        <th style="color: white;" scope="col">Historial</th>

                        <?php if ($_GET['reporte'] != "no seleccionado") { ?>


                            <th style="color: white;" scope="col">
                                <a style="color: white;" href="../Controller/AddAllReporteController.php?buscar=<?php echo "" . $_GET['buscar']?>&reporte=<?php echo $reporte ?>&comuna=<?php echo "" . $_GET['comuna']?>&observacion=<?php echo "" . $_GET['observacion']?>&origen=<?php echo "" . $_GET['origen']?>&proveedor=<?php echo "" . $_GET['proveedor']?>&item_gasto=<?php echo "" . $_GET['item_gasto']?>&ubicacion=<?php echo "" . $_GET['ubicacion']?>&desde=<?php echo "" . $desde ?>&hasta=<?php echo "" . $hasta ?>">
                                    Agregar todos
                                </a>
                            </th>

                        <?php     }  ?>

                    </tr>
                </thead>



                <tbody>



                    <?php



                    while ($row = $Allitem->fetchArray(SQLITE3_ASSOC)) {

                        $color = "";

                        if ($row['BIEN_CAMBIO'] == 'CAMBIO') {
                            $color = "#fef9e7";
                        }

                    ?>

                        <tr style="background-color:<?php echo $color ?>">
                            <td style="font-size:80%; width: 10%;"><?php echo "" . $row['NOMBRE_UBICACION'] ?></td>
                            <td style="font-size:80%; width: 20%;"><?php echo "" . $row['NOMBRE'] ?></td>
                            <td style=font-size:80%><?php echo "" . $row['ITEM_GASTO'] ?></td>
                            <td style=font-size:80%><?php echo "" . $row['CODIGO'] ?></td>
                            <td style="font-size:80%; width: 9%; text-align: center; "> <?php echo "" . $row['NUMERO_FACTURA'] ?></td>
                            <td style="font-size:80%; text-align: center; "><?php echo "$" . number_format($row['VALOR'], 0, PHP_ROUND_HALF_UP, '.') ?></td>
                            <td style="font-size:80%; width: 20%;"><?php echo "" . $row['NOMBRE_PROVEEDOR'] ?></td>
                            <td style=font-size:80%><?php echo "" . $row['ORIGEN'] ?></td>
                            <td style="font-size:80%; text-align: center; "><?php echo "" . $row['CANTIDAD'] ?></td>
                            <td style=font-size:80%><?php echo "" . $row['OBSERVACION'] ?></td>

                            <td style="text-align: center;">
                                <a href="/View/DetallesBien.php?comuna=<?php echo "" . $row["COMUNA"] ?>&observacion=<?php echo "" . $row["OBSERVACION"] ?>&
                                                origen=<?php echo "" . $row["ORIGEN"] ?>&proveedor=<?php echo "" . $row["NOMBRE_PROVEEDOR"] ?>&item_gasto=<?php echo "" . $row["ITEM_GASTO"] ?>&
                                                ubicacion=<?php echo "" . $row["NOMBRE_UBICACION"] ?>&nombre=<?php echo "" . $row["NOMBRE"] ?>&cantidad=<?php echo "" . $row["CANTIDAD"] ?>
                                                &valor=<?php echo "" . $row["VALOR"] ?>&destino=<?php echo "" . $row["DESTINO"] ?>&codigo=<?php echo "" . $row["CODIGO"] ?>
                                                &id_bien=<?php echo "" . $row["ID_BIEN"] ?>&fecha=<?php echo "" . $row["FECHA"] ?>&bien_cambio=<?php echo "" . $row["BIEN_CAMBIO"] ?>
                                                &fecha_compra=<?php echo "" . $row["FECHA_COMPRA"] ?>&numero_factura=<?php echo "" . $row["NUMERO_FACTURA"] ?> ">
                                    <i style="color: black;" class="bi bi-eye-fill"></i></a>



                            </td>

                            <?php if ($_GET['reporte'] != "no seleccionado") { ?>
                                <td style="text-align: center;">

                                    <a href="../Controller/AddReporteController.php?reporte=<?php echo $reporte?>&nombre=<?php echo "" . $row['NOMBRE']?>&codigo=<?php echo "" . $row["CODIGO"]?>&cantidad=<?php echo "" . $row["CANTIDAD"]?>&fecha_compra=<?php echo "" . $row["FECHA_COMPRA"]?>&rut=<?php echo "" . $row["RUT"]?>&proveedor=<?php echo "" . $row["NOMBRE_PROVEEDOR"]?>&valor=<?php echo "" . $row["VALOR"]?>&observacion=<?php echo "" . $row["OBSERVACION"]?>&ubicacion=<?php echo "" . $row["NOMBRE_UBICACION"]?>&factura=<?php echo "" . $row["NUMERO_FACTURA"]?>&item_gasto=<?php echo "" . $row["ITEM_GASTO"]?>&origen=<?php echo "" . $row["ORIGEN"]?>&destino=<?php echo "" . $row["DESTINO"]?>&comuna=<?php echo "" . $row["COMUNA"]?>">
                                        <i style="color: black;" class="bi bi-plus-circle"></i>
                                    </a>
                                </td>

                            <?php     }  ?>





                        </tr>


                        <tr style="height: 3px;">
                            <td colspan="12"></td>
                        </tr>
                    <?php
                    }
                    ?>



                </tbody>
            </table>

        </div>
        

    </div>
    <div class="invisible">
        <input name="bienes" value="<?php echo "" . $cantidadBienes ?>" required class="invisible"></input>
        <input name="num" value="<?php echo "" . $limitenum ?>" required class="invisible"></input>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="../bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>

<!doctype html>



<script>
    var bienes = parseInt(document.querySelector("input[name='bienes']").value);
    var num = parseInt(document.querySelector("input[name='num']").value)




    window.onload = function() {
        var pos = window.name || 0;
        window.scrollTo(0, pos);
        var contenedor = document.getElementById('cargando');
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity= '0';
    }
    window.onunload = function() {
        window.name = self.pageYOffset || (document.documentElement.scrollTop + document.body.scrollTop);
    }


    $(window).on("scroll", function() {

        let userInput = document.getElementsByName('money-amount');
        inputNum = parseInt(userInput.value);

        console.log(inputNum)

        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if (((scrollHeight - scrollPosition) / scrollHeight === 0 && bienes > num)) {

            location.replace("../View/Reportes.php?comuna=<?php echo "" . $_GET["comuna"] ?>&observacion=<?php echo "" . $_GET["observacion"] ?>&origen=<?php echo "" . $_GET["origen"] ?>&proveedor=<?php echo "" . $_GET["proveedor"] ?>&item_gasto=<?php echo "" . $_GET["item_gasto"] ?>&ubicacion=<?php echo "" . $_GET["ubicacion"] ?>&buscar=<?php echo "" . $_GET['buscar'] ?>&limit=<?php echo "" . $limitenum ?>&reporte=<?php echo "" . $_GET['reporte'] ?>");

        }
    });

    $btnOficina = document.querySelector("#btnOficina");

    $btnOficina.addEventListener("click", () => {
        ventana = window.open("../ViewReporte/oficina.php?reporte=oficina");
    });




    $btnRobo = document.querySelector("#btnRobo");

    $btnRobo.addEventListener("click", () => {
        ventana = window.open("../ViewReporte/robo.php?reporte=robo");
    });

    $btnBaja = document.querySelector("#btnBaja");

    $btnBaja.addEventListener("click", () => {
        ventana = window.open("../ViewReporte/baja.php?reporte=baja");
    });
    $btnIncorporacion = document.querySelector("#btnIncorporacion");

    $btnIncorporacion.addEventListener("click", () => {
        ventana = window.open("../ViewReporte/incorporacion.php?reporte=incorporacion");
    });

    $btnFiltro = document.querySelector("#btnFiltro");

    $btnFiltro.addEventListener("click", () => {
        ventana = window.open("../ViewReporte/todo_filtro.php?reporte=todo_filtro");
    });


    // Llamada desde la hija
</script>