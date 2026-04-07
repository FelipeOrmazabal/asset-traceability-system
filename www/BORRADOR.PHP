<?php

?>


<html>
<link rel="stylesheet" href="../../bootstrap-4.6.2-dist/css/bootstrap.min.css">
<script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
<script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>
<script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>

<div class="invisible">

    <table id="tabla">


        <thead>
            <tr>
                <th>UBICACION</th>
                <th>BIEN</th>
                <th>ITEM GASTO</th>
                <th>CODIGO</th>
                <th>DOCUMENTO ADQUISICION / N° FACTURA</th>
                <th>VALOR DE LA COMPRA</th>
                <!-- <th>FECHA COMPRA</th> -->
                <th>PROVEEDOR</th>
                <!-- <th>RUT PROVEEDOR</th>  -->
                <th>ORIGEN (Transferencia - Adquisicion)</th>
                <th>CANTIDAD</th>
                <th>OBSERVACION</th>
                <th>DESTINO NO UTILIZABLE</th>

            </tr>
        </thead>



        <tbody>
            <?php

            while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {


            ?>
                <tr>


                    <td><?php echo "" . $row['NOMBRE_UBICACION'] ?></td>

                    <td><?php echo "" . $row['NOMBRE'] ?></td>
                    <td><?php echo "" . $row['ITEM_GASTO'] ?></td>
                    <td><?php echo "" . $row['CODIGO'] ?></td>
                    <td><?php echo "" . $row['NUMERO_FACTURA'] ?></td>
                    <td>

                        <?php
                        if ($row['VALOR'] < 1000) {

                            echo "" . $row['VALOR'];
                        } else {
                            echo "$ " . number_format($row['VALOR'], 0, ",", ".");
                        }

                        ?></td>
                    <!-- <td><?php echo "" .  $newDate = date("d/m/Y", strtotime($row["FECHA_COMPRA"])) ?></td> -->
                    <td><?php echo "" . $row['NOMBRE_PROVEEDOR'] ?></td>
                    <!-- <td ><?php echo "" . $row['RUT'] ?></td>  -->
                    <td><?php echo "" . $row['ORIGEN'] ?></td>
                    <td><?php echo "" . $row['CANTIDAD'] ?></td>
                    <td><?php echo "" . $row['OBSERVACION'] ?></td>
                    <td><?php echo "" . $row['DESTINO'] ?></td>







                <?php
            }
            $db->close();
                ?>




        </tbody>
    </table>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->



<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
<script>
    // function exportar() {
    //     $tabla = document.querySelector("#tabla");


    //     let tableExport = new TableExport($tabla, {
    //         exportButtons: false, // No queremos botones
           
    //         filename: "ReporteTodo", //Nombre del archivo de Excel
    //         sheetname: "Inventario", //Título de la hoja
    //     });
    //     let datos = tableExport.getExportData();
    //     let preferenciasDocumento = datos.tabla.xlsx;
    //     tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType, preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento.merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);

    // }

    // exportar();


    // history.back();

   
</script>

</html>
