<?php
require_once("../DataBase/DbConfig.php");
require_once("../Model/BienModel.php");




$item = new BienModel;
$desde = "";
$hasta = "";
$page = "bienes";

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

  $Allitem = $item->readBuscar( $_GET['buscar'], $limitenum);
  $cantidadBienes = $item->cantidadReadBuscar( $_GET['buscar']);
}

if (isset($_GET['desde']) && $_GET['desde'] != ""  || isset($_GET['hasta']) && $_GET['hasta'] != "") {


  $Allitem = $item->readFecha($_GET["comuna"], $_GET["observacion"], $_GET["origen"], $_GET["proveedor"], $_GET["item_gasto"], $_GET["ubicacion"],  $desde, $hasta, $limitenum);
  $cantidadBienes = $item->cantidadReadFecha($_GET["comuna"], $_GET["observacion"], $_GET["origen"], $_GET["proveedor"], $_GET["item_gasto"], $_GET["ubicacion"],  $desde, $hasta);
}



$show = "collapse";
$idcomuna = 1;

$readonly = "readonly";
$disabled = "disabled";

$idfiltro = "ID_COMUNA";
if (isset($_GET['comunatodos'])) {
  $idfiltro = $_GET['comunatodos'];
}
if (isset($_GET['comunau'])) {

  $idcomuna = $_GET['comunau'];
  $show = "show";
  $readonly = "";
  $disabled = "";
}
$ubicacionComuna = $item->readUbicacionComuna($idcomuna);
$ubicacionFiltro = $item->readUbicacionComuna($idfiltro);
$ubicacion = $item->readUbicacion();
$item_gasto = $item->readItem_gasto();
$proveedor = $item->readProveedor();
$origen = $item->readOrigen();
$observacion = $item->readObservacion();
$comuna = $item->readComuna();
$archivo = $item->readArchivo("0");

?>


<!doctype html>
<html class="panel-body" lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../bootstrap-4.6.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap-4.6.2-dist/css/bootstrap.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css">
  <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/messages/messages.es-es.js"></script>
  <link rel="stylesheet" href="../bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">


  <?php require_once("Modules/header.php");?>
</head>


<body>


  <div id="cargando" style="  background-color: white; z-index: 1000; height: 100%; width: 100%; position: fixed;   " role="status">

    <div style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto;" class="spinner-border text-primary  " role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>


  <div class="accordion " aria-multiselectable="true" id="accordionExample">



    <div class="row col  panel-body  ">
      <div class="ml-10 col panel-body " id="headingOne">
        <label> </label>
        <p class="panel-body ">
          <button style="background-color: #0000ff; color: white" class=" panel-body btn " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false">
            Agregar Bien
          </button>
        </p>
      </div>

      <div style="padding-right: 320px;" class="col row panel-body  ">
        <form method="post" class="form-inline" action="../Controller/BuscarBienController.php?comuna=<?php echo "" . $_GET["comuna"] ?>&observacion=<?php echo "" . $_GET["observacion"] ?>&origen=<?php echo "" . $_GET["origen"] ?>&proveedor=<?php echo "" . $_GET["proveedor"] ?>&item_gasto=<?php echo "" . $_GET["item_gasto"] ?>&ubicacion=<?php echo "" . $_GET["ubicacion"] ?>&buscar=<?php $_GET['buscar'] ?>&pagina=bienes&comunahead=<?php echo  "" . $_GET['comunahead'] ?>&comunatodos=<?php echo "" . $_GET['comunatodos'] ?>&limit=<?php echo "" . $limitenum ?>">
          <input style="width: 320px;" required name="buscar" class=" panel-body  form-control mr-sm-2" type="search" placeholder="Buscar: Codigo/Nombre" aria-label="Buscar">
          <button style="background-color: #0000ff; color: white;" class="btn " type="submit">Buscar</button>
        </form>
      </div>


      <div class="panel-body " id="headingTwo">
        <label> </label>
        <p>
          <button style="background-color: #0000ff; color: white" class="btn " type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false">
            Filtrar
          </button>
        </p>
      </div>
    </div>



    <div id="collapseTwo" style="z-index: 2;" class="collapse  col position-absolute" data-parent="#accordionExample">


      <?php include("Modules/Filtro.php") ?>

    </div>

    <div id="collapseOne" style="z-index: 2;" class="<?php echo "" . $show ?> position-absolute col" data-parent="#accordionExample">

      <div style="padding: 4px;" class="card border border-2 border-dark  ">
        <div style="background-color: #0000ff;" class="card border border-2 border-dark">
          <div class="card-body">
            <form method="post" action="../Controller/AddBienController.php?comuna=<?php echo "" . $_GET["comuna"] ?>&observacion=<?php echo "" . $_GET["observacion"] ?>&origen=<?php echo "" . $_GET["origen"] ?>&proveedor=<?php echo "" . $_GET["proveedor"] ?>&item_gasto=<?php echo "" . $_GET["item_gasto"] ?>&ubicacion=<?php echo "" . $_GET["ubicacion"] ?>&buscar=<?php echo "" . $_GET['buscar'] ?>&comunahead=<?php echo  "" . $_GET['comunahead'] ?>&comunatodos=<?php echo "" . $_GET['comunatodos'] ?>&limit=<?php echo "" . $limitenum ?>" enctype="multipart/form-data">
              <div class="form-row font-weight-bold">


                <div class="">
                  <label style="color: white;" for=""> Centro de Negocios</label>
                  <div class="dropdown  ">
                    <button style="background-color: white;width: 155px; " class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                      <?php
                      if (isset($_GET["comunan"])) {
                        echo "" . $_GET["comunan"];
                      } else {
                        echo "CDN";
                      }
                      ?>
                    </button>
                    <div class="dropdown-menu">
                      <?php
                      while ($row = $comuna->fetchArray(SQLITE3_ASSOC)) {
                      ?>
                        <a href="/View/Bien.php?comunau=<?php echo "" . $row['ID_COMUNA'] ?>&comunan=<?php echo "" . $row['COMUNA'] ?>&comuna=<?php echo "" . $_GET["comuna"] ?>&observacion=<?php echo "" . $_GET["observacion"] ?>&origen=<?php echo "" . $_GET["origen"] ?>&proveedor=<?php echo "" . $_GET["proveedor"] ?>&item_gasto=<?php echo "" . $_GET["item_gasto"] ?>&ubicacion=<?php echo "" . $_GET["ubicacion"] ?>&buscar=<?php echo "" . $_GET['buscar'] ?>&comunahead=<?php echo  "" . $_GET['comunahead'] ?>&comunatodos=<?php echo "" . $_GET['comunatodos'] ?>&limit=<?php echo "" . $limitenum ?>" class="dropdown-item"> <?php echo "" . $row['COMUNA'] ?> </a>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <label style="color: white;" for=""> Ubicacion</label>
                  <select <?php echo "" . $disabled ?> name="ubicacion" required class="form-control" id="inputGroupSelect02">
                    <?php

                    while ($row = $ubicacionComuna->fetchArray(SQLITE3_ASSOC)) {
                    ?>
                      <option value="<?php echo "" . $row['ID_UBICACION'] ?> "> <?php echo "" . $row['NOMBRE_UBICACION'] ?> </option>

                    <?php
                    }
                    ?>

                  </select>
                </div>
                <div class="col">
                  <label style="color: white;" for=""> Bien</label>
                  <input <?php echo "" . $readonly ?> type="text" name="nombre" required class="form-control">
                </div>

                <div class="col">
                  <label style="color: white;" for=""> Item gasto</label>
                  <select <?php echo "" . $disabled ?> name="item_gasto" required class="form-control" id="inputGroupSelect02">
                    <?php

                    while ($row = $item_gasto->fetchArray(SQLITE3_ASSOC)) {
                    ?>
                      <option value="<?php echo "" . $row['ID_ITEM_GASTO'] ?> "> <?php echo "" . $row['ITEM_GASTO'] ?> </option>

                    <?php
                    }
                    ?>

                  </select>
                </div>

                <div class="col ">
                  <label style="color: white;" for=""> Codigo</label>
                  <input <?php echo "" . $readonly ?> type="text" name="codigo" id="lala" required class="form-control  ">
                </div>


                <div style="max-width: 90px;" class=" col ">
                  <label style="color: white;" for=""> N° factura</label>
                  <input <?php echo "" . $readonly ?> type="text" name="factura" required class="form-control">
                </div>

                <div style="max-width: 120px;" class=" col ">
                  <label style="color: white;" for=""> Valor</label>
                  <input <?php echo "" . $readonly ?> type="number" name="valor" min="0" required class="form-control">
                </div>





                <div class="col">
                  <label style="color: white;" for=""> Proveedor</label>
                  <select <?php echo "" . $disabled ?> name="proveedor" required class="form-control" id="inputGroupSelect02">
                    <?php

                    while ($row = $proveedor->fetchArray(SQLITE3_ASSOC)) {
                    ?>
                      <option value="<?php echo "" . $row['ID_PROVEEDOR'] ?> "> <?php echo "" . $row['NOMBRE_PROVEEDOR'] ?> </option>

                    <?php
                    }
                    ?>

                  </select>
                </div>
                <div class="col">
                  <label style="color: white;" for=""> Origen</label>
                  <select <?php echo "" . $disabled ?> name="origen" required class="form-control" id="inputGroupSelect02">
                    <?php

                    while ($row = $origen->fetchArray(SQLITE3_ASSOC)) {
                    ?>
                      <option value="<?php echo "" . $row['ID_ORIGEN'] ?> "> <?php echo "" . $row['ORIGEN'] ?> </option>

                    <?php
                    }
                    ?>

                  </select>
                </div>


                <div style="max-width: 80px;" class=" col ">
                  <label style="color: white;" for=""> Cantidad</label>
                  <input <?php echo "" . $readonly ?> type="number" name="cantidad" min="1" required class="form-control">
                </div>






                <div class="col">
                  <label style="color: white;" for=""> Observacion</label>
                  <select <?php echo "" . $disabled ?> name="observacion" required class="form-control" id="inputGroupSelect02">
                    <?php

                    while ($row = $observacion->fetchArray(SQLITE3_ASSOC)) {
                    ?>
                      <option value="<?php echo "" . $row['ID_OBSERVACION'] ?> "> <?php echo "" . $row['OBSERVACION'] ?> </option>

                    <?php
                    }
                    ?>

                  </select>
                </div>

                <div class="col">
                  <label style="color: white;" for=""> Destino no utilizable </label>
                  <input <?php echo "" . $readonly ?> type="text" name="destino" class="form-control">
                </div>





              </div>
              <label> </label>

              <div class="form-row d-flex justify-content-between align-items-center ">

                <div style="margin-left: 10px;" class="row  ">
                  <label style="font-weight: bold; color: white;" for=""> Fecha compra:</label>

                  <div class="col ">

                    <input required name="fecha_compra" id="datepicker3" width="250" />
                    <script>
                      $('#datepicker3').datepicker({
                        uiLibrary: 'bootstrap4',
                        format: 'dd-mm-yyyy',
                        locale: 'es-es',


                      });
                    </script>
                  </div>
                </div>

                <?php if (isset($_GET['ultimo'])) {  ?>

                  <div><a style="color: white;font-weight: bold;" href="" onclick="history.back()">Ultimo bien <i class="bi bi-arrow-clockwise"></i></a></div>

                <?php }  ?>

                <div class="row">
                  <div class="" style="padding-right:20px;">
                    <div>
                      <div class="custom-file">
                        <input <?php echo "" . $readonly ?> type="file" class="custom-file-input" name="archivos[]" multiple id="customFileLang" lang="es">
                        <label class="custom-file-label" for="customFileLang">Subir Archivo</label>
                      </div>
                    </div>



                  </div>




                  <div style="padding-right:20px;">

                    <button type="submit" <?php echo "" . $disabled ?> class="btn btn-outline-light">Guardar</button>

                  </div>

                </div>

              </div>


            </form>
          </div>
        </div>
      </div>






      <label for=""> </label>
    </div>



  </div>



  <div style="  height: 100%;
  position: relative;" class="col panel-body">

    <div class="accordion panel-body " id="accordionExample2">
      <table class="panel-body  table table-sm  ">


        <thead class="panel-body" style="position: sticky; top: 63px; background-color: #ff0000;">
          <tr class="panel-body">

            <th class="panel-body" style="color: white;" scope="col">UBICACION</th>
            <th class="panel-body" style="color: white;" scope="col">BIEN</th>
            <th class="panel-body" style="color: white;" scope="col">ITEM GASTO</th>
            <th class="panel-body" style="color: white;" scope="col ">CODIGO</th>
            <th class="panel-body" style="color: white;" scope="col">N° FACTURA</th>
            <th class="panel-body" style="color: white;" scope="col">VALOR</th>
            <th class="panel-body" style="color: white;" scope="col">PROVEEDOR</th>
            <th class="panel-body" style="color: white;" scope="col">ORIGEN</th>
            <th class="panel-body" style="color: white;" scope="col">CANTIDAD</th>
            <th class="panel-body" style="color: white;" scope="col">OBSERVACION</th>
            <th class="panel-body" style="color: white;" scope="col">HISTORIAL</th>
            <th class="panel-body" style="color: white;" scope="col">EDITAR</th>

          </tr>
        </thead>



        <tbody>



          <?php



          while ($row = $Allitem->fetchArray(SQLITE3_ASSOC)) {

            $color = "";

            if ($row['BIEN_CAMBIO'] == 'CAMBIO') {
              $color = "#fef9e7";
            }
            //   if ($row['OBSERVACION'] == 'NO UTILIZABLE') {
            //     $color = "#e70909";
            // }



          ?>

            <tr class="panel-body" style="background-color:<?php echo $color ?>">
              <td class="panel-body" style="font-size:80%; width: 10%;"><?php echo "" . $row['NOMBRE_UBICACION'] ?></td>
              <td class="panel-body" style="font-size:80%; width: 20%;"><?php echo "" . $row['NOMBRE'] ?></td>
              <td class="panel-body" style=font-size:80%><?php echo "" . $row['ITEM_GASTO'] ?></td>
              <td class="panel-body" style=font-size:80%><?php echo "" . $row['CODIGO'] ?></td>
              <td class="panel-body" style="font-size:80%; width: 9%; text-align: center; "> <?php echo "" . $row['NUMERO_FACTURA'] ?></td>
              <td class="panel-body" style="font-size:80%; text-align: center; "><?php echo "$" . number_format($row['VALOR'], 0, PHP_ROUND_HALF_UP, '.') ?></td>
              <td class="panel-body" style="font-size:80%; width: 20%;"><?php echo "" . $row['NOMBRE_PROVEEDOR'] ?></td>
              <td class="panel-body" style=font-size:80%><?php echo "" . $row['ORIGEN'] ?></td>
              <td class="panel-body" style="font-size:80%; text-align: center; "><?php echo "" . $row['CANTIDAD'] ?></td>
              <td class="panel-body" style=font-size:80%><?php echo "" . $row['OBSERVACION'] ?></td>




              <td class="panel-body" style="text-align: center;">
                <a href="/View/DetallesBien.php?comuna=<?php echo "" . $row["COMUNA"] ?>&observacion=<?php echo "" . $row["OBSERVACION"] ?>&origen=<?php echo "" . $row["ORIGEN"] ?>&proveedor=<?php echo "" . $row["NOMBRE_PROVEEDOR"] ?>&item_gasto=<?php echo "" . $row["ITEM_GASTO"] ?>&ubicacion=<?php echo "" . $row["NOMBRE_UBICACION"] ?>&nombre=<?php echo "" . $row["NOMBRE"] ?>&cantidad=<?php echo "" . $row["CANTIDAD"] ?>&valor=<?php echo "" . $row["VALOR"] ?>&destino=<?php echo "" . $row["DESTINO"] ?>&codigo=<?php echo "" . $row["CODIGO"] ?>&id_bien=<?php echo "" . $row["ID_BIEN"] ?>&fecha=<?php echo "" . $row["FECHA"] ?>&bien_cambio=<?php echo "" . $row["BIEN_CAMBIO"] ?>&fecha_compra=<?php echo "" . $row["FECHA_COMPRA"] ?>&numero_factura=<?php echo "" . $row["NUMERO_FACTURA"] ?>">
                  <i style="color: black;" class="bi bi-eye-fill"></i></a>



              </td>

              <td class="panel-body" style="text-align: center;"> <a href="#lala<?php echo "" . $row['ID_BIEN'] ?>" data-toggle="collapse" aria-controls="collapseExample">


                  <i style="color: black;" class="panel-body bi bi-pen-fill"></i>
                </a></td>





            </tr>



            <?php include("Modules/EditarBien.php"); ?>


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
<script>
  var bienes = parseInt(document.querySelector("input[name='bienes']").value);
  var num = parseInt(document.querySelector("input[name='num']").value)




  window.onload = function() {
    var pos = window.name || 0;
    window.scrollTo(0, pos);

    var contenedor = document.getElementById('cargando');
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity = '0';

  }
  window.onunload = function() {
    window.name = self.pageYOffset || (document.documentElement.scrollTop + document.body.scrollTop);
  }

  $(document).click(function(e) {
    if ($(e.target).is('.panel-body')) {
      $('.collapse').collapse('hide');
    }
  });


  $(window).on("scroll", function() {

    let userInput = document.getElementsByName('money-amount');
    inputNum = parseInt(userInput.value);

    console.log(inputNum)

    var scrollHeight = $(document).height();
    var scrollPosition = $(window).height() + $(window).scrollTop();
    if (((scrollHeight - scrollPosition) / scrollHeight === 0 && bienes > num)) {

      location.replace("../View/Bien.php?comuna=<?php echo "" . $_GET["comuna"]?>&observacion=<?php echo "" . $_GET["observacion"]?>&origen=<?php echo "" . $_GET["origen"]?>&proveedor=<?php echo "" . $_GET["proveedor"]?>&item_gasto=<?php echo "" . $_GET["item_gasto"]?>&ubicacion=<?php echo "" . $_GET["ubicacion"]?>&buscar=<?php echo "" . $_GET['buscar'] ?>&limit=<?php echo "" . $limitenum?>&comunahead=<?php echo  "" . $_GET['comunahead']?>&comunatodos=<?php echo "" . $_GET['comunatodos']?>&desde=<?php echo "" . $desde?>&hasta=<?php echo "" . $hasta?>");

    }
  });
</script>