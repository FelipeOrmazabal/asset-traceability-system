

<tr class=" panel-body">

  <td  class="col  panel-body" colspan="12">

 
  <div  class="collapse position-absolute col "  id="lala<?php echo "" . $row['ID_BIEN'] ?>">

      <div style="padding: 4px;" class="card border border-2 border-dark  ">
        <div style="background-color: #0000ff;" class="card border border-2 border-dark ">
          <div class="card-body ">



            <form method="post" action="../Controller/EditBienController.php?comuna=<?php echo "" . $_GET["comuna"]?>&observacion=<?php echo "" . $_GET["observacion"]?>&origen=<?php echo "" . $_GET["origen"]?>&proveedor=<?php echo "" . $_GET["proveedor"]?>&item_gasto=<?php echo "" . $_GET["item_gasto"]?>&ubicacion=<?php echo "" . $_GET["ubicacion"]?>&comunaH=<?php echo "" . $row["ID_COMUNA"]?>&observacionH=<?php echo "" . $row["ID_OBSERVACION"]?>&origenH=<?php echo "" . $row["ID_ORIGEN"]?>&proveedorH=<?php echo "" . $row["ID_PROVEEDOR"]?>&item_gastoH=<?php echo "" . $row["ID_ITEM_GASTO"]?>&ubicacionH=<?php echo "" . $row["ID_UBICACION"]?>&nombreH=<?php echo "" . $row["NOMBRE"]?>&destinoH=<?php echo "" . $row["DESTINO"]?>&codigoH=<?php echo "" . $row["CODIGO"]?>&buscar=<?php echo "" . $_GET['buscar']?>&bien_cambio=<?php echo "" . $row['BIEN_CAMBIO']?>&comunahead=<?php echo  "" . $_GET['comunahead']?>&comunatodos=<?php echo "" . $_GET['comunatodos']?>&limit=<?php echo "" . $limitenum?>" enctype="multipart/form-data">
              <div class="form-row font-weight-bold">


                <div class="invisible " style="width: 0px;">

                  <input type="text" name="id_bien" value="<?php echo "" . $row['ID_BIEN'] ?>" class="form-control">
                </div>
                <div class="invisible " style="width: 0px;">

                  <input type="text" name="fecha_compra" value="<?php echo "" . $row['FECHA_COMPRA'] ?>" class="form-control">
                </div>
                <div class="col">
                  <label style="color: white;" for=""> Ubicacion</label>
                  <select name="ubicacion" required class="form-control" value="<?php echo "" . $row['ID_UBICACION'] ?>" id="inputGroupSelect02">
                    <option value="<?php echo "" . $row['ID_UBICACION'] ?>"><?php echo "" . $row['NOMBRE_UBICACION'] ?></option>
                    <?php
                    $separador = 1;
                    while ($row2 = $ubicacion->fetchArray(SQLITE3_ASSOC)) {
                    ?>

                      <option value="<?php echo "" . $row2['ID_UBICACION'] ?> "> <?php echo "" . $row2['NOMBRE_UBICACION'] ?> </option>



                    <?php   } ?>


                  </select>
                </div>
                <div class="col">
                  <label style="color: white;" for=""> Nombre</label>
                  <input type="text" name="nombre" value="<?php echo "" . $row['NOMBRE'] ?>" required class="form-control">
                </div>


                <div class="col">
                  <label style="color: white;" for=""> Item gasto</label>
                  <select name="item_gasto" required class="form-control" id="inputGroupSelect02">
                    <option value="<?php echo "" . $row['ID_ITEM_GASTO'] ?>" selected><?php echo "" . $row['ITEM_GASTO'] ?></option>
                    <?php

                    while ($row3 = $item_gasto->fetchArray(SQLITE3_ASSOC)) {
                    ?>
                      <option value="<?php echo "" . $row3['ID_ITEM_GASTO'] ?> "> <?php echo "" . $row3['ITEM_GASTO'] ?> </option>

                    <?php
                    }
                    ?>

                  </select>
                </div>





                <div class="col">
                  <label style="color: white;" for=""> Codigo</label>
                  <input type="text" name="codigo" value="<?php echo "" . $row['CODIGO'] ?>" class="form-control">
                </div>
                <div style="max-width: 90px;" class=" col ">
                  <label style="color: white;" for=""> N° Factura</label>
                  <input style="max-width: 120px; background-color: white;" readonly="readonly" type="text" name="numero_factura" value="<?php echo "" . $row['NUMERO_FACTURA'] ?>" required class="form-control">
                </div>
                <div style="max-width: 120px;" class=" col ">
                  <label style="color: white;" for=""> Valor</label>
                  <input style="max-width: 120px; background-color: white;" readonly="readonly" type="number" min="1" name="valor" value="<?php echo "" . $row['VALOR'] ?>" required class="form-control">
                </div>

                <div class="col">
                  <label style="color: white;" for=""> Origen</label>
                  <select name="origen" required class="form-control" id="inputGroupSelect02">
                    <option value="<?php echo "" . $row['ID_ORIGEN'] ?>" selected><?php echo "" . $row['ORIGEN'] ?>...</option>
                    <?php

                    while ($row6 = $origen->fetchArray(SQLITE3_ASSOC)) {
                    ?>
                      <option value="<?php echo "" . $row6['ID_ORIGEN'] ?> "> <?php echo "" . $row6['ORIGEN'] ?> </option>

                    <?php
                    }
                    ?>

                  </select>
                </div>



                <div style="max-width: 80px;" class=" col ">
                  <label style="color: white;" for=""> Cantidad</label>
                  <input style="max-width: 75px; background-color: white;" readonly type="number" min="1" name="cantidad" value="<?php echo "" . $row['CANTIDAD'] ?>" required class="form-control">
                </div>









                <div class="invisible " style="width: 0px;">
                  <input type="text" name="proveedor" value="<?php echo "" . $row['ID_PROVEEDOR'] ?>" class="form-control">
                </div>





                <div class="col">
                  <label style="color: white;" for=""> Observacion</label>
                  <select name="observacion" required class="form-control" id="inputGroupSelect02">
                    <option value="<?php echo "" . $row['ID_OBSERVACION'] ?>" selected><?php echo "" . $row['OBSERVACION'] ?>...</option>
                    <?php

                    while ($row5 = $observacion->fetchArray(SQLITE3_ASSOC)) {
                    ?>
                      <option value="<?php echo "" . $row5['ID_OBSERVACION'] ?> "> <?php echo "" . $row5['OBSERVACION'] ?> </option>

                    <?php
                    }
                    ?>

                  </select>
                </div>



                <div class="col">
                  <label style="color: white;" for=""> Destino no utilizable</label>
                  <input type="text" name="destino" value="<?php echo "" . $row['DESTINO'] ?>" class="form-control">
                </div>


              </div>
              <label> </label>

              <div class="form-row ">
                <div class="col ">


                  <input type="text" required name="descripcion" placeholder="Descripcion de Cambio" class="form-control">

                </div>

                <?php if ($row['CANTIDAD'] > 1) {



                ?>

                  <div class="col " style="max-width:15%; padding-right: 20px; padding-left: 20px; ">


                    <input type="number" required name="cantidad_cambio" min="1" max="<?php echo "" . $row['CANTIDAD'] ?>" placeholder="Cantidad a cambiar" class="form-control">

                  </div>

                <?php } else {    ?>



                  <input class="invisible" type="number" name="cantidad_cambio" value="-1" class="form-control">




                <?php    } ?>


                <div class="" style="padding-right:10px;">
                  <div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="archivos[]" multiple id="customFileLang" lang="es">
                      <label class="custom-file-label" for="customFileLang">Subir Archivo</label>
                    </div>
                  </div>
                </div>


                <div class="">

                  <button type="submit" class="btn btn-outline-light">Guardar</button>

                </div>



              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </td>

</tr>
