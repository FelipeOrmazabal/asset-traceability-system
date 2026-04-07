<?php

require_once("../DataBase/DbConfig.php");



$db = new MyDB;


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
ORDER BY COMUNA.COMUNA ASC , UBICACION.ID_UBICACION ASC , BIEN.CODIGO ASC

";

$ret = $db->query($sql);





?>


<html>
<link rel="stylesheet" href="../../bootstrap-4.6.2-dist/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>

<div class="invisible">

    <table id="tabla">


        <thead>
            <tr>
                <th>CENTRO DE NEGOCIOS</th>
                <th>UBICACION</th>
                <th>BIEN</th>
                <th>ITEM GASTO</th>
                <th>CODIGO</th>
                <th>DOCUMENTO ADQUISICION / N° FACTURA</th>
                <th>VALOR DE LA COMPRA</th>
                <th>FECHA COMPRA</th>
                <th>PROVEEDOR</th>
                <th>RUT PROVEEDOR</th>
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

                    <td><?php echo "" . $row['COMUNA'] ?></td>
                    <td><?php echo "" . $row['NOMBRE_UBICACION'] ?></td>

                    <td><?php echo "" . $row['NOMBRE'] ?></td>
                    <td><?php echo "" . $row['ITEM_GASTO'] ?></td>
                    <td><?php echo "" . $row['CODIGO'] ?></td>
                    <td><?php echo "" . $row['NUMERO_FACTURA'] ?></td>
                    <td><?php echo "$ " . number_format($row['VALOR'], 0, ",", "."); ?></td>
                    <td><?php echo "" .  $newDate = date("d/m/Y", strtotime($row["FECHA_COMPRA"])) ?></td>
                    <td><?php echo "" . $row['NOMBRE_PROVEEDOR'] ?></td>
                    <td><?php echo "" . $row['RUT'] ?></td>
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
    function exportTableToExcel(tableElement, filename) {
        const table = document.querySelector(tableElement);
        const tableData = [];

        // Extract table data
        table.querySelectorAll('tr').forEach(row => {
            const rowData = [];
            row.querySelectorAll('th, td').forEach(cell => {
                rowData.push(cell.textContent);
            });
            tableData.push(rowData);
        });

        // Create worksheet
        const worksheet = XLSX.utils.aoa_to_sheet(tableData);

        // Create workbook
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Inventario');

        // Export the workbook to Excel file
        XLSX.writeFile(workbook, filename);
    }



    exportTableToExcel('#tabla', 'ExporteTodo.xlsx');

    history.back();
</script>

</html>