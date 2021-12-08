<?php
    //se destruye la sesion y las variables de los usuarios y se redirige al inicio.
    session_start();
    session_unset();
    session_destroy();
    header("location:../index.php");
?>