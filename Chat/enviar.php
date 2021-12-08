<?php
    //Sesión activa se redirecciona a la seccion anterior 
    session_start();
    if(!isset($_SESSION['client_on']) && !isset($_SESSION['admin_on'])){
?>
    <script language="JavaScript">
        window.alert("Primero debe identificarse");
        window.history.back();
    </script>   
<?php   
    exit(0);
}
    //Conectar al servidor Mysql y a la base de datos
    include ("../DB_FUNCTIONS/DB_connection.php");
    //La conexion es conne
    echo "<script>console.log('hola')</script>";
    //Extraemos la tabla productos (id y existancia)
    if(isset($_SESSION['admin_on'])){
        $sql = "INSERT INTO `chat_mensaje` (`Id_chat_msj`,`Id_usuario`, `chat_msj`,`status`) VALUES".
        " (NULL, '".$_SESSION['chat']."', '".$_POST['mensaje']."', '1');";
        echo "<script type=\"text/javascript\">window.location=\"chat.php?chat=".$_SESSION['chat']."\";</script>";
    }
    else{
        $sql = "INSERT INTO `chat_mensaje` (`Id_chat_msj`,`Id_usuario`, `chat_msj`,`status`) VALUES ".
        "(NULL, '".$_SESSION['chat']."','".$_POST['mensaje']."', '0');";
        echo "<script type=\"text/javascript\">window.location=\"chat.php\";</script>";
    }
   $r = $conne->query($sql);
   echo $r;
    echo "<script>console.log('.$r.')</script>";
?>
