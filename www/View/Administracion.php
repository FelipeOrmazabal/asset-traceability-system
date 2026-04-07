<?php require_once("../Model/BienModel.php");
$item = new BienModel;

$ubicacion = $item->readUbicacion();
$item_gasto = $item->readItem_gasto();
$proveedor = $item->readProveedor();
$origen = $item->readOrigen();
$observacion = $item->readObservacion();
$comuna = $item->readComuna();
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

    <?php include("Modules/header.php") ?>

</head>


<label></label>


<body   style="overflow: hidden;"  >

    <div class="form-row col">





        <div class="col">
            <form method="post" action="../Controller/AddComunaController.php">
                <div class="form-row">

                    <div class="col">
                        <label for="">  Centro de negocios</label>
                        <input type="text" name="comuna" required class="form-control">
                    </div>

                </div>
                <label> </label>
                <div>

                    <button type="submit" class="btn btn-outline-primary">Agregar</button>

                </div>
                <label> </label>


            </form>

            <div class="overflow-auto"    style="height: 66vh ;" >
                <table class="table table-sm">

                    <tbody>
                        <?php
                        while ($row = $comuna->fetchArray(SQLITE3_ASSOC)) {
                        ?>
                            <tr>
                                <td style=font-size:90%><?php echo "" . $row['COMUNA'] ?></td>
                                <td style=font-size:90%> <button class="btn" type="button" data-toggle="collapse" data-target="#c<?php echo "" . $row['ID_COMUNA'] ?>" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="bi bi-pen-fill"></i>
                                    </button></td>
                            </tr>
                            <tr>
                                <td style=font-size:90% colspan="2">
                                    <div class="collapsing " style="height:0" id="c<?php echo "" . $row['ID_COMUNA'] ?>">
                                        <form method="post" action="../Controller/EditComunaController.php?id_comuna=<?php echo "" . $row['ID_COMUNA'] ?>">
                                            <div class="form-row">



                                                <input type="text" required name="comuna" value="<?php echo "" . $row['COMUNA'] ?>" class="form-control" ITEM_GASTO>


                                            </div>
                                            <label> </label>
                                            <div>

                                                <button type="submit" class="btn btn-outline-primary"> guardar</button>

                                            </div>
                                        </form>

                                    </div>

                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>






        <div class="col">
            <form method="post" action="../Controller/AddUbicacionController.php">
                <div class="form-row">

                    <div class="col">
                        <label for=""> Ubicacion (CDN)</label>
                        <input type="text" name="ubicacion" required class="form-control">
                    </div>

                </div>
                <div class="">
                    <label for=""> Centro de negocios</label>
                    <select name="comuna" required class="form-control" id="inputGroupSelect02">
                        <option value="UBICACION.ID_UBICACION" selected></option>
                        <?php

                        while ($row = $comuna->fetchArray(SQLITE3_ASSOC)) {
                        ?>
                            <option value="<?php echo "" . $row['ID_COMUNA'] ?> "> <?php echo "" . $row['COMUNA'] ?> </option>

                        <?php
                        }
                        ?>

                    </select>
                </div>
                <label> </label>
                <div>

                    <button type="submit" class="btn btn-outline-primary">Agregar</button>

                </div>
                <label> </label>


            </form>

            <div class="overflow-auto"    style="height: 66vh ;" >
                <table class="table table-sm">

                    <tbody>
                        <?php
                        while ($row = $ubicacion->fetchArray(SQLITE3_ASSOC)) {
                        ?>
                            <tr>
                                <td style=font-size:90%><?php echo "" . $row['NOMBRE_UBICACION'] ?></td>
                                <td style=font-size:90%> <button class="btn" type="button" data-toggle="collapse" data-target="#u<?php echo "" . $row['ID_UBICACION'] ?>" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="bi bi-pen-fill"></i>
                                    </button></td>
                            </tr>
                            <tr>
                                <td style=font-size:90% colspan="2">
                                    <div class="collapsing " style="height:0" id="u<?php echo "" . $row['ID_UBICACION'] ?>">
                                        <form method="post" action="../Controller/EditUbicacionController.php?id_ubicacion=<?php echo "" . $row['ID_UBICACION'] ?>">
                                            <div class="form-row">



                                                <input type="text" name="ubicacion" value="<?php echo "" . $row['NOMBRE_UBICACION'] ?>" class="form-control">


                                            </div>
                                            <label> </label>
                                            <div>

                                                <button type="submit" class="btn btn-outline-primary"> guardar</button>

                                            </div>
                                        </form>

                                    </div>

                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>

        <div class="col">
            <form method="post" action="../Controller/AddProveedorController.php">
                <div class="form-row">

                    <div class="col">
                        <label for=""> Proveedor</label>
                        <input type="text" name="proveedor" required class="form-control">
                    </div>

                </div>
                <div class="form-row">

                    <div class="col">
                        <label for=""> Rut</label>
                        <input type="text" name="rut" required class="form-control">
                    </div>

                </div>
                <label> </label>
                <div>

                    <button type="submit" class="btn btn-outline-primary">Agregar</button>

                </div>
                <label> </label>


            </form>

            <div class="overflow-auto"    style="height: 66vh ;" >
                <table class="table table-sm">

                    <tbody>
                        <?php
                        while ($row = $proveedor->fetchArray(SQLITE3_ASSOC)) {
                        ?>
                            <tr>
                                <td style=font-size:90%><?php echo "" . $row['NOMBRE_PROVEEDOR'] ?></td>
                                <td style=font-size:90%> <button class="btn" type="button" data-toggle="collapse" data-target="#p<?php echo "" . $row['ID_PROVEEDOR'] ?>" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="bi bi-pen-fill"></i>
                                    </button></td>
                            </tr>
                            <tr>
                                <td style=font-size:90% colspan="2">
                                    <div class="collapsing " style="height:0" id="p<?php echo "" . $row['ID_PROVEEDOR'] ?>">
                                        <form method="post" action="../Controller/EditProveedorController.php?id_proveedor=<?php echo "" . $row['ID_PROVEEDOR'] ?>">
                                          
                                            <div  class="form-row mb-2">



                                                <input type="text" name="proveedor" value="<?php echo "" . $row['NOMBRE_PROVEEDOR'] ?>" class="form-control">


                                            </div>
                                            
                                            <div class="form-row mb-2">



                                                <input type="text" name="rut" value="<?php echo "" . $row['RUT'] ?>" class="form-control">


                                            </div>
                                            <div>

                                                <button type="submit" class="btn btn-outline-primary"> guardar</button>

                                            </div>
                                        </form>

                                    </div>

                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>







        <div class="col">
            <form method="post" action="../Controller/AddItemGastoController.php">
                <div class="form-row">

                    <div class="col">
                        <label for=""> Item gasto</label>
                        <input type="text" name="item_gasto" required class="form-control">
                    </div>

                </div>
                <label> </label>
                <div>

                    <button type="submit" class="btn btn-outline-primary">Agregar</button>

                </div>
                <label> </label>


            </form>

            <div class="overflow-auto"    style="height: 66vh ;" >
                <table class="table table-sm">

                    <tbody>
                        <?php
                        while ($row = $item_gasto->fetchArray(SQLITE3_ASSOC)) {
                        ?>
                            <tr>
                                <td style=font-size:90%><?php echo "" . $row['ITEM_GASTO'] ?></td>
                                <td style=font-size:90%> <button class="btn" type="button" data-toggle="collapse" data-target="#i<?php echo "" . $row['ID_ITEM_GASTO'] ?>" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="bi bi-pen-fill"></i>
                                    </button></td>
                            </tr>
                            <tr>
                                <td style=font-size:90% colspan="2">
                                    <div class="collapsing " style="height:0" id="i<?php echo "" . $row['ID_ITEM_GASTO'] ?>">
                                        <form method="post" action="../Controller/EditItemGastoController.php?id_item_gasto=<?php echo "" . $row['ID_ITEM_GASTO'] ?>">
                                            <div class="form-row">



                                                <input type="text" name="item_gasto" value="<?php echo "" . $row['ITEM_GASTO'] ?>" class="form-control" ITEM_GASTO>


                                            </div>
                                            <label> </label>
                                            <div>

                                                <button type="submit" class="btn btn-outline-primary"> guardar</button>

                                            </div>
                                        </form>

                                    </div>

                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>










        <div class="col">
            <form method="post" action="../Controller/AddObservacionController.php">
                <div class="form-row">

                    <div class="col">
                        <label for=""> Observacion</label>
                        <input type="text" name="observacion" required class="form-control">
                    </div>

                </div>
                <label> </label>
                <div>

                    <button type="submit" class="btn btn-outline-primary">Agregar</button>

                </div>
                <label> </label>


            </form>

            <div class="overflow-auto"    style="height: 66vh ;" >
                <table class="table table-sm">

                    <tbody>
                        <?php
                        while ($row = $observacion->fetchArray(SQLITE3_ASSOC)) {
                        ?>
                            <tr>
                                <td style=font-size:90%><?php echo "" . $row['OBSERVACION'] ?></td>
                                <td style=font-size:90%> <button class="btn" type="button" data-toggle="collapse" data-target="#o<?php echo "" . $row['ID_OBSERVACION'] ?>" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="bi bi-pen-fill"></i>
                                    </button></td>
                            </tr>
                            <tr>
                                <td style=font-size:90% colspan="2">
                                    <div class="collapsing " style="height:0" id="o<?php echo "" . $row['ID_OBSERVACION'] ?>">
                                        <form method="post" action="../Controller/EditObservacionController.php?id_observacion=<?php echo "" . $row['ID_OBSERVACION'] ?>">
                                            <div class="form-row">



                                                <input type="text" name="observacion" value="<?php echo "" . $row['OBSERVACION'] ?>" class="form-control" ITEM_GASTO>


                                            </div>
                                            <label> </label>
                                            <div>

                                                <button type="submit" class="btn btn-outline-primary"> guardar</button>

                                            </div>
                                        </form>

                                    </div>

                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>












        <div class="col">
            <form method="post" action="../Controller/AddOrigenController.php">
                <div class="form-row">

                    <div class="col">
                        <label for=""> Origen</label>
                        <input type="text" name="origen" required class="form-control">
                    </div>

                </div>
                <label> </label>
                <div>

                    <button type="submit" class="btn btn-outline-primary">Agregar</button>

                </div>
                <label> </label>


            </form>

            <div class="overflow-auto"    style="height: 66vh ;" >
                <table class="table table-sm">

                    <tbody>
                        <?php
                        while ($row = $origen->fetchArray(SQLITE3_ASSOC)) {
                        ?>
                            <tr>
                                <td style=font-size:90%><?php echo "" . $row['ORIGEN'] ?></td>
                                <td style=font-size:90%> <button class="btn" type="button" data-toggle="collapse" data-target="#or<?php echo "" . $row['ID_ORIGEN'] ?>" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="bi bi-pen-fill"></i>
                                    </button></td>
                            </tr>
                            <tr>
                                <td style=font-size:90% colspan="2">
                                    <div class="collapsing " style="height:0" id="or<?php echo "" . $row['ID_ORIGEN'] ?>">
                                        <form method="post" action="../Controller/EditOrigenController.php?id_origen=<?php echo "" . $row['ID_ORIGEN'] ?>">
                                            <div class="form-row">



                                                <input type="text" required name="origen" value="<?php echo "" . $row['ORIGEN'] ?>" class="form-control" ITEM_GASTO>


                                            </div>
                                            <label> </label>
                                            <div>

                                                <button type="submit" class="btn btn-outline-primary"> guardar</button>

                                            </div>
                                        </form>

                                    </div>

                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>















        <label for=""> </label>


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