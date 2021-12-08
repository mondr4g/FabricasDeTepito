<?php
    include '../global/config.php';

    //ESTA ES LA CONEXION QUE SE UTILIZARA EN LOS QUERYS
    $conne = mysqli_connect(SERVER,USUARIO,PASSWORD,BD);

    if(!$conne){
        die("Error: conexion incorrecta".mysqli_connect_error());
    }
?> 