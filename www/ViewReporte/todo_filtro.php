<?php
if (!isset($_GET['reload'])) {
    header("refresh:0;url=../ViewReporte/todo_filtro.php?reporte=todo_filtro&reload=1");
}


if (isset($_GET['recarga'])) {

    if (strval($_GET['recarga'])  != "adentro") {

        header("refresh:1;url=../ViewReporte/todo_filtro.php?reporte=todo_filtro&reload=1&recarga=1");
    }
}


require_once("../Model/ReporteModel.php");


$todofiltro = new ReporteModel;
$todofiltro = $todofiltro->readTodoFiltro();

?>


<html>





<!doctype html>
<html style="z-index: 5;" onmouseleave="afuera()" onmouseenter="adentro()" lang="es">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>


</head>


<?php if (isset($_GET['reload'])) { ?>

    <body style="overflow: hidden;">


        <div class="overflow-auto" style="padding-top: 20px; height: 100vh ; " class="col">

            <button style="margin-bottom:10px ;" onclick="exportTableToExcel('#tabla', 'ExporteconFiltro.xlsx')" class="btn btn-outline-primary">
                <i class="fas fa-file-excel"></i> Exportar a Excel
            </button>
            <table id="tabla" class=" table table-sm  table-bordered ">


                <thead>
                <tr id="row">
                        <th id="col">COMUNA</th>
                        <th id="col">UBICACION</th>
                        <th id="col">BIEN</th>
                        <th id="col">ITEM GASTO</th>
                        <th id="col">CODIGO</th>
                        <th id="col">DOCUMENTO ADQUISICION / N° FACTURA</th>
                        <th id="col">VALOR DE LA COMPRA</th>
                        <th id="col">FECHA COMPRA</th>
                        <th id="col">PROVEEDOR</th>
                        <th id="col">RUT PROVEEDOR</th>
                        <th id="col">ORIGEN (Transferencia - Adquisicion)</th>
                        <th id="col">CANTIDAD</th>
                        <th id="col">OBSERVACION</th>
                        <th id="col">DESTINO NO UTILIZABLE</th>


                        <th>
                            <a href="../Controller/DeleteReporteController.php?reporte=<?php echo "" . $_GET['reporte'] ?>&id=<?php echo "" . $row['ID'] ?>&deleteall=1">
                                Borrar todos

                            </a>
                        </th>



                    </tr>
                </thead>



                <tbody>
                    <?php
                    $cantidad = 0;

                    while ($row = $todofiltro->fetchArray(SQLITE3_ASSOC)) {

                        $cantidad = $cantidad + 1;

                    ?>
                        <tr id="row">


                            <td id="col"><?php echo "" . $row['COMUNA'] ?></td>
                            <td id='col'><?php echo "" . $row['UBICACION'] ?></td>

                            <td id="col"><?php echo "" . $row['BIEN'] ?></td>
                            <td id="col"><?php echo "" . $row['ITEM_GASTO'] ?></td>
                            <td id="col"><?php echo "" . $row['CODIGO'] ?></td>
                            <td id="col"><?php echo "" . $row['NUMERO_FACTURA'] ?></td>
                            <td id="col"><?php echo "$ " . number_format($row['VALOR'], 0, ",", "."); ?></td>
                            <td id="col"><?php echo "" .  $newDate = date("d/m/Y", strtotime($row["FECHA_COMPRA"])) ?></td>
                            <td id="col"><?php echo "" . $row['PROVEEDOR'] ?></td>
                            <td id="col"><?php echo "" . $row['RUT'] ?></td>
                            <td id="col"><?php echo "" . $row['ORIGEN'] ?></td>
                            <td id="col"><?php echo "" . $row['CANTIDAD'] ?></td>
                            <td id="col"><?php echo "" . $row['OBSERVACION'] ?></td>
                            <td id="col"><?php echo "" . $row['DESTINO'] ?></td>

                            <td>
                                <a href="../Controller/DeleteReporteController.php?reporte=<?php echo "" . $_GET['reporte'] ?>&id=<?php echo "" . $row['ID'] ?>&deleteall=0&idp=<?php echo "" . $cantidad ?>">
                                    🗑️
                                </a>
                            </td>
                        </tr>
                        <tr  >
                            <td>
                                <div class="invisible" id="la<?php echo "" . $cantidad ?>"></div>

                            </td>

                        </tr>

                    <?php
                    }
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
    </body>

<?php } ?>
<input class="invisible" name="recarga" value="<?php echo "" . $_GET['recarga'] ?>">

</html>
<script>
    function adentro() {


        var recarga = parseInt(document.querySelector("input[name='recarga']").value)
        if (recarga == "1") {
            location.replace("../ViewReporte/todo_filtro.php?reporte=todo_filtro&recarga=adentro&reload=1");
        }
    }

    function afuera() {

        location.replace("../ViewReporte/todo_filtro.php?reporte=todo_filtro&recarga=1&reload=1");

    }



    function exportTableToExcel(tableElement, filename) {
        const table = document.querySelector(tableElement);
        const tableData = [];

        // Extract table data
        table.querySelectorAll("tr[id='row']").forEach(row => {
            const rowData = [];
            row.querySelectorAll("th[id='col'], td[id='col'] ").forEach(cell => {
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
</script>