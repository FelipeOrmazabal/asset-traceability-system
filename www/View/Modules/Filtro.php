

<div style="padding: 4px;" class="card border border-2 border-dark  ">
  <div style="background-color: #0000ff;" class="card border border-2 border-dark">
    <div class="card-body">





      <form method="post" action="../Controller/FiltroBienController.php?comuna=<?php echo "" . $_GET["comuna"]?>&buscar=<?php $_GET['buscar']?>&pagina=<?php echo"".$page?>&reporte=<?php echo"".$_GET['reporte']?>&comunahead=<?php echo  "" . $_GET['comunahead']?>&comunatodos=<?php echo "" . $_GET['comunatodos']?>&limit=<?php echo "" . $limitenum?>">
        <div class="form-row font-weight-bold">





          <div class="col">
            <label style="color: white;" for=""> Ubicacion</label>
            <select name="ubicacion" required class="form-control" id="inputGroupSelect02">
              <option value="UBICACION.ID_UBICACION" selected> TODOS</option>
              <?php

              while ($row = $ubicacionFiltro->fetchArray(SQLITE3_ASSOC)) {
              ?>
                <option value="<?php echo "" . $row['ID_UBICACION'] ?> "> <?php echo "" . $row['NOMBRE_UBICACION'] ?> </option>

              <?php
              }
              ?>

            </select>
          </div>

          <div class="col">
            <label style="color: white;" for=""> Item gasto</label>
            <select name="item_gasto" required class="form-control" id="inputGroupSelect02">
              <option value="ITEM_GASTO.ID_ITEM_GASTO" selected>TODOS</option>
              <?php

              while ($row = $item_gasto->fetchArray(SQLITE3_ASSOC)) {
              ?>
                <option value="<?php echo "" . $row['ID_ITEM_GASTO'] ?> "> <?php echo "" . $row['ITEM_GASTO'] ?> </option>

              <?php
              }
              ?>

            </select>
          </div>

          <div class="col">
            <label style="color: white;" for=""> Proveedor</label>
            <select name="proveedor" required class="form-control" id="inputGroupSelect02">
              <option value="PROVEEDOR.ID_PROVEEDOR" selected>TODOS</option>
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
            <select name="origen" required class="form-control" id="inputGroupSelect02">
              <option value="ORIGEN.ID_ORIGEN" selected>TODOS</option>
              <?php

              while ($row = $origen->fetchArray(SQLITE3_ASSOC)) {
              ?>
                <option value="<?php echo "" . $row['ID_ORIGEN'] ?> "> <?php echo "" . $row['ORIGEN'] ?> </option>

              <?php
              }
              ?>

            </select>
          </div>

          <div class="col">
            <label style="color: white;" for=""> Observacion</label>
            <select name="observacion" required class="form-control" id="inputGroupSelect02">
              <option value="OBSERVACION.ID_OBSERVACION" selected>TODOS</option>
              <?php

              while ($row = $observacion->fetchArray(SQLITE3_ASSOC)) {
              ?>
                <option value="<?php echo "" . $row['ID_OBSERVACION'] ?> "> <?php echo "" . $row['OBSERVACION'] ?> </option>

              <?php
              }
              ?>

            </select>
          </div>

                <?php if ($page == "reporte") {?>
       
                  <div class="col">
            <label style="color: white;" for="">  Centro de negocios</label>
            <select name="comuna" required class="form-control" id="inputGroupSelect02">
              <option value="COMUNA.ID_COMUNA" selected>TODOS</option>
              <?php

              while ($row = $comuna->fetchArray(SQLITE3_ASSOC)) {
              ?>
                <option value="<?php echo "" . $row['ID_COMUNA'] ?> "> <?php echo "" . $row['COMUNA'] ?> </option>

              <?php
              }
              ?>

            </select>
          </div>
                  <?php  }  ?>
              
       


          <div class="" style="padding-top:31px;">
            <label style="color: white;" for=""></label>
            <button type="submit" class="btn btn-outline-light">Aplicar</button>

          </div>


        </div>
        <div class="row col mt-4">
          <div style="margin-left: 10px;" class="row  ">
            <label style="font-weight: bold; color: white; margin-right: 50;" for=""> Fecha de compra:</label>
            <label style="font-weight: bold; color: white; " for=""> Desde:</label>
            <div class="col ">

              <input  name="desde" id="datepicker" width="250" />
              <script>
                $('#datepicker').datepicker({
                  uiLibrary: 'bootstrap4',
                  format: 'dd-mm-yyyy',
                  locale: 'es-es',


                });
              </script>
            </div>
          </div>
          <div style="margin-left: 10px;" class="row  ">
            <label style="font-weight: bold; color: white;" for=""> Hasta:</label>

            <div class="col ">

              <input  name="hasta" id="datepicker2" width="250" />
              <script>
                $('#datepicker2').datepicker({
                  uiLibrary: 'bootstrap4',
                  format: 'dd-mm-yyyy',
                  locale: 'es-es',


                });
              </script>
            </div>
          </div>
        </div>
        <label> </label>

      </form>




    </div>
  </div>
</div>

<label for=""> </label>
