<?php

require_once("../Model/BienModel.php");
$item = new BienModel;
$comuna = $item->readComuna();



?>
<div class="sticky-top  sticky-offset">
  <nav class="navbar   navbar-expand-lg " style="background-color:#002da7;">


    <button style="color: white;" onclick="history.back()" class="btn btn-lg"><i class="bi bi-arrow-left-circle"></i>
    </button>

    <a style="color: white;" class="navbar-brand" href="/View/index.php">Inicio</a>




    <div class="collapse navbar-collapse" id="navbarSupportedContent">



      <ul class="navbar-nav mr-auto">




        <li class="nav-item dropdown">
          <a style="color: white;" class="nav-link nav-item active dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            Bienes
          </a>
          <div class="dropdown-menu">



            <a class="dropdown-item" href="/View/Bien.php?comuna=COMUNA.ID_COMUNA&observacion=OBSERVACION.ID_OBSERVACION&origen=ORIGEN.ID_ORIGEN&proveedor=PROVEEDOR.ID_PROVEEDOR&item_gasto=ITEM_GASTO.ID_ITEM_GASTO&ubicacion=UBICACION.ID_UBICACION&buscar=nada&comunahead=TODOS LOS BIENES&comunatodos=ID_COMUNA">TODOS</a>
            <div class="dropdown-divider"></div>

            <?php

            while ($row7 = $comuna->fetchArray(SQLITE3_ASSOC)) {
            ?>
              <a class="dropdown-item" href="/View/Bien.php?comuna=<?php echo "" . $row7['ID_COMUNA']?>&observacion=OBSERVACION.ID_OBSERVACION&origen=ORIGEN.ID_ORIGEN&proveedor=PROVEEDOR.ID_PROVEEDOR&item_gasto=ITEM_GASTO.ID_ITEM_GASTO&ubicacion=UBICACION.ID_UBICACION&buscar=nada&comunahead=<?php echo "BIENES " . $row7['COMUNA']?>&comunatodos=<?php echo "" . $row7['ID_COMUNA']?>"><?php echo "" . $row7['COMUNA'] ?></a>
            <?php

            }
            ?>



          </div>
        </li>
        <li class="nav-item active">
          <a style="color: white;" class="nav-link" href="/View/Reportes.php?comuna=COMUNA.ID_COMUNA&observacion=OBSERVACION.ID_OBSERVACION&origen=ORIGEN.ID_ORIGEN&proveedor=PROVEEDOR.ID_PROVEEDOR&item_gasto=ITEM_GASTO.ID_ITEM_GASTO&ubicacion=UBICACION.ID_UBICACION&reporte=no seleccionado&buscar=nada">Reportes <span class="sr-only"></span></a>
        </li>

      </ul>
      <?php if (isset($_GET["comunahead"])) {

      ?>


        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a style="color: white; font-weight: bold;" class="nav-link"> <?php echo "" . $_GET['comunahead']; ?> <span class="sr-only"></span></a>
          </li>
        </ul>



      <?php  } ?>





      <ul class="navbar-nav ml-auto">

      </ul>
      <ul class="navbar-nav ml-auto">

      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a style="color: white;" class="nav-link" href=" /View/Administracion.php?">Administracion <span class="sr-only"></span></a>
        </li>
      </ul>


    </div>
  </nav>

</div>
