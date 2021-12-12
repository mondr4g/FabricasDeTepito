<?php
    include '../global/config.php';

    //ESTA ES LA CONEXION QUE SE UTILIZARA EN LOS QUERYS
    /*$conne = mysqli_connect(SERVER,USUARIO,PASSWORD,BD);

    if(!$conne){
        die("Error: conexion incorrecta".mysqli_connect_error());
    }*/

    $conne = oci_connect("MONDRAG","1234","localhost/XE");

    if (!$conne) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
?> 