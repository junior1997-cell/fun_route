<?php

function enrutamiento($tipo, $file){
  if ($tipo == 'nube') {
    $link_host = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
  } else if ($tipo == 'local') {    
    $link_host =  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/fun_route";    
  }
  return $link_host;
}

if ($_SERVER['HTTP_HOST'] == "localhost") {
  $ruta = enrutamiento('local', $file_go);
} else {
  $ruta = enrutamiento('nube', $file_go);
}

header("Location: $ruta");
