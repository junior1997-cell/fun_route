<?php  

    $ruta = "";

    function enrutamiento($tipo) {
        if ($tipo == 'nube') {
            $link_host = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/';
        }else{
            if ($tipo == 'local') {
<<<<<<< HEAD
                $link_host = "http://localhost/front_sevens/admin/";
=======
                $link_host = "http://localhost/page_amazon_lab/admin/";
>>>>>>> cae41abf91959a0e6fc33cf97519c0cb99f6595e
            }            
        }
        return $link_host;
    }

    if ($_SERVER['HTTP_HOST'] == "localhost") {
        $ruta = enrutamiento('local');
    } else {
        $ruta = enrutamiento('nube');
    }  

    header("Location: $ruta");
?>