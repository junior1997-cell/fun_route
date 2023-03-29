
<?php

require_once "../modelos/Contador.php";

$contador = new Contador();

$pagina = isset($_POST["pagina"]) ? limpiarCadena($_POST["pagina"]) : "";

$rspta =  $contador->registrarVisita($pagina);

echo json_encode($rspta, true);