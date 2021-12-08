<?php
    session_start();

    include '../DB_FUNCTIONS/DB_functions.php';

    if(isset($_SESSION['admin_on'])){
        //Aqui a gregar la parte a procesar

        if(isset($_POST['btnAction'])){
            switch($_POST['btnAction']){
                case 'Add_us':
                    header('location:regist.php');
                    break;
                case 'Add_prod':
                    header('location:Add_producto.php');
                    break;
                case 'Add_ofer':
                    header('location:Add_ofer.php');
                    break;
            }
        }
        
        if(isset($_POST['btnActionUs'])){
            $id_us=$_POST['id_us'];
            switch($_POST['btnActionUs']){
                case 'Eliminar':
                    if($id_us!=$_SESSION['admin_on']){
                        //proceder a eliminar

                        //Haber si podemos meter un yes/no
                        if(delete_user($id_us)){
                            //
                            echo "<script>alert('Usuario eliminado :c');</script>";
                        }else{
                            echo "<script>alert('error');</script>";
                        }
                    } 
                    break; 
                case 'Actualizar':
                    //Conviene recuperar los datos y mostrarlos en un formulario para luego modificarlos y volver a sobrescribir el registro.
                    switch($_POST['tipo']){
                        case 'ad':
                            $imp="a";
                            break;
                        case 'cl':
                            $imp="c";
                            break;
                    }
                    header("location:edit_registro.php?id_us=$id_us&tipo=u&imp=$imp");
                    break;
               
            }

        }
        if(isset($_POST['btnActionProd'])){
            $id_prod=$_POST['id_prod'];
            switch($_POST['btnActionProd']){
                case 'Eliminar':
                    //Aqui tambien realizar la confirmacion.
                    if(delete_product($id_prod)){
                        echo "<script>alert('Producto Eliminado!! :c');</script>";

                    }else{
                        echo "<script>alert('error');</script>";
                    }
                    
                    break;
                case 'Actualizar':
                    header("location:edit_registro.php?id_prod=$id_prod&tipo=p");
                    break;
                case 'Agregar':
                    header("location:Add_producto.php");
                    break;

            }
        }
    } else {
        header("Location: ../index.php");
    }

?>