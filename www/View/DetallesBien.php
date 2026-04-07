<?php
require_once("../Model/BienModel.php");
require_once("../Model/HistorialModel.php");
$item = new BienModel;
$bienH = new HistorialModel;


$id_bien = $_GET['id_bien'];
$codigo     = $_GET['codigo'];
$nombre = $_GET['nombre'];
$cantidad    = $_GET['cantidad'];
$valor    = $_GET['valor'];
$ubicacion    = $_GET['ubicacion'];
$item_gasto = $_GET['item_gasto'];
$fecha = $_GET['fecha'];


$proveedor    = $_GET['proveedor'];
$origen    = $_GET['origen'];
$observacion    = $_GET['observacion'];
$destino = $_GET['destino'];
$fecha_compra = $_GET['fecha_compra'];
$numero_factura = $_GET['numero_factura'];



?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <script src="../bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">


    <title>Hello, world!</title>
    <?php include("Modules/header.php") ?>
</head>


<body>



    <label for=""></label>

    <div class="col">
        <table class="table table-sm">
            <thead class="thead-light" style="background-color: #ff0000;">
                <tr>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Item gasto</th>
                    <th scope="col">Código</th>
                    <th scope="col">N° Factura</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Origen</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Observación</th>
                    <th scope="col">Destino no utilizable</th>
                    <th scope="col">Comuna</th>
                    <th scope="col">Fecha compra</th>
                    <th scope="col">Fecha ingreso</th>


                </tr>
            </thead>
            <tbody>

                <?php

                $color = "";

                if ($_GET['bien_cambio'] == 'CAMBIO') {
                    $color = "#fef9e7";
                }

                ?>

                <tr style="background-color:<?php echo $color ?>">
                    <td style=font-size:80%><?php echo "" . $ubicacion ?></td>
                    <td style="font-size:80% ;width: 20%;" > <?php echo "" . $nombre ?></td>
                    <td style=font-size:80%><?php echo "" . $item_gasto ?></td>
                    <td style=font-size:80%><?php echo "" . $codigo ?></td>
                    <td style="font-size:80% ; text-align: center;"><?php echo "" . $numero_factura ?></td>
                    <td style="font-size:80% ;text-align: center;"><?php echo "$" . number_format($valor, 0, PHP_ROUND_HALF_UP, '.')   ?></td>
                    <td style=font-size:80%><?php echo "" . $proveedor ?></td>
                    <td style=font-size:80%><?php echo "" . $origen ?></td>
                    <td style="font-size:80% ;text-align: center;"><?php echo "" . $cantidad  ?></td>
                    <td style=font-size:80%><?php echo "" . $observacion  ?></td>
                    <td style=font-size:80%><?php echo "" . $destino  ?></td>
                    <td style=font-size:80%><?php echo "" . $_GET['comuna'];  ?></td>
                    <td style=font-size:80%><?php echo "" . $newDate = date("d/m/Y", strtotime($fecha_compra)); ?></td>
                    <td style=font-size:80%><?php echo "" . $newDate = date("d/m/Y", strtotime($fecha)); ?></td>


                </tr>
            </tbody>
        </table>





        <div class="col form-row">




            <div class="card col ">
                <h6 class="card-header d-flex justify-content-center" style="font-weight: bold;">Documentos</h6>
                <div class="card-body form-row d-flex justify-content-between align-items-center">

                    <div>
                        <?php
                        $archivo = $item->readArchivo($id_bien);
                        while ($row2 = $archivo->fetchArray(SQLITE3_ASSOC)) { ?>
                            <label><i style="color: black;" class="bi bi-file-earmark-text-fill"></i></label>
                            <label style="padding-right:4px;">
                                <a target="_blank" href="../Documento.php?archivo=<?php echo "" . $row2['NOMBRE'] ?>"> <?php echo "" . $row2['NOMBRE'] ?>
                                </a>

                            </label>
                            <label>-</label>

                        <?php }
                        ?>
                    </div>

                </div>
            </div>



            <div class="card ">
                <h6 class="card-header d-flex justify-content-center"> Subir Documentos</h6>
                <div class="card-body form-row d-flex justify-content-between align-items-center">
                    <form method="post" action="../Controller/AddArchivoController.php?comuna=<?php echo "" . $_GET["comuna"] ?>&observacion=<?php echo "" . $_GET["observacion"] ?>&
                                                origen=<?php echo "" . $_GET["origen"] ?>&proveedor=<?php echo "" . $_GET["proveedor"] ?>&item_gasto=<?php echo "" . $_GET["item_gasto"] ?>&
                                                ubicacion=<?php echo "" . $_GET["ubicacion"] ?>&nombre=<?php echo "" . $_GET["nombre"] ?>&cantidad=<?php echo "" . $_GET["cantidad"] ?>
                                                &valor=<?php echo "" . $_GET["valor"] ?>&destino=<?php echo "" . $_GET["destino"] ?>&codigo=<?php echo "" . $_GET["codigo"] ?>
                                                &id_bien=<?php echo "" . $_GET["id_bien"] ?>&fecha=<?php echo "" . $_GET["fecha"] ?>&bien_cambio=<?php echo "" . $_GET["bien_cambio"] ?> 
                                                &fecha_compra=<?php echo "" . $_GET["fecha_compra"] ?> &numero_factura=<?php echo "" . $_GET["numero_factura"] ?> 
                                                  " enctype="multipart/form-data">

                        <div class="form-row">


                            <div class="">
                                <div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="archivos[]" multiple id="customFileLang" lang="es">
                                        <label class="custom-file-label" for="customFileLang">Subir Documento</label>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right" style="padding-left: 7px;">

                                <button type="submit" class="btn btn-dark">guardar</button>

                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>


    </div>
    <div class="col">
        <hr class="mt-4 mb-3" />
    </div>
    <div class="col" style="margin-top: 1%;">

        <div class="card">
            <h6 style="font-weight: bold;" class="card-header d-flex justify-content-center ">Historal Bien</h6>
            <div class="card-body">

                <?php

                $historial = $bienH->readBienHistorial($id_bien);
                $cantidad = 0;
                while ($row = $historial->fetchArray(SQLITE3_ASSOC)) {

                    $cantidad = $cantidad + 1;
                };


                while ($row = $historial->fetchArray(SQLITE3_ASSOC)) {

                    $cantidad = $cantidad - 1;
                    $color = "";
                    if ($row['BIEN_CAMBIO'] == 'CAMBIO') {
                        $color = "#fef9e7";
                    }
                    // if ($row['OBSERVACION'] == 'NO UTILIZABLE') {
                    //     $color = "#e70909";
                    // }

                ?>

                    <div class="form-row justify-content-between align-items-center ">
                        <label style="font-weight: bold;"><?php echo "" . $row['DESCRIPCION'] ?> </label>

                        <?php if ($row['DESCRIPCION'] == 'PRIMER INGRESO') { ?>
                            <label style="font-weight: bold;"><?php echo "  Fecha ingreso: " . $newDate = date("d/m/Y", strtotime($row['FECHA'])); ?> </label>
                        <?php  } else { ?>

                            <label style="font-weight: bold;"><?php echo "  Fecha cambio: " . $newDate = date("d/m/Y", strtotime($row['FECHA'])); ?> </label>
                        <?php     } ?>







                    </div>

                    <table class="table table-sm">
                        <thead class="thead-light" style="background-color: #ff0000;">
                            <tr>


                                <th scope="col">Ubicación</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Item gasto</th>
                                <th scope="col">Código</th>
                                <th scope="col">N° Factura</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Origen</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Observación</th>
                                <th scope="col">Destino no utilizable</th>
                                <th scope="col">Comuna</th>
                                <th scope="col">Fecha compra</th>
                             



                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color:<?php echo $color ?>">

                             
                                <td style=font-size:80%><?php echo "" . $row['NOMBRE_UBICACION'] ?></td>
                                <td style="font-size:80%;width: 20%;"><?php echo "" . $row['NOMBRE'] ?></td>
                                <td style=font-size:80% ><?php echo "" . $row['ITEM_GASTO'] ?></td>
                                <td style=font-size:80%><?php echo "" . $row['CODIGO'] ?></td>
                                <td style="font-size:80% ;text-align: center;"><?php echo "" . $row['NUMERO_FACTURA'] ?></td>
                                <td style="font-size:80% ;text-align: center;"><?php echo "$" . number_format($row['VALOR'], 0, PHP_ROUND_HALF_UP, '.') ?></td>
                                <td style=font-size:80%><?php echo "" . $row['NOMBRE_PROVEEDOR'] ?></td>
                                <td style=font-size:80%><?php echo "" . $row['ORIGEN'] ?></td>
                                <td style="font-size:80% ;text-align: center;"><?php echo "" . $row['CANTIDAD'] ?></td>
                                <td style=font-size:80%><?php echo "" . $row['OBSERVACION'] ?></td>
                                <td style=font-size:80%><?php echo "" . $row['DESTINO'] ?></td>
                                <td style=font-size:80%><?php echo "" . $row['COMUNA']  ?></td>
                                <td style=font-size:80%><?php echo "" .  $newDate = date("d/m/Y", strtotime($row["FECHA_COMPRA"]));?></td>




                            </tr>
                        </tbody>
                    </table>

                    <?php





                    if ($cantidad !== 0) {

                    ?>

                        <div class="d-flex justify-content-center">
                            <i style="font-size: 25px;" class="bi position-relative center-block  bi-arrow-down-circle">
                            </i>
                        </div>

                    <?php   } ?>



                <?php   } ?>

            </div>

        </div>

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