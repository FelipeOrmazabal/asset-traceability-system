<?php
header("content-type: application/pdf");


$archivo = $_GET['archivo'];
readfile("../www/Documentos/$archivo");

?>

