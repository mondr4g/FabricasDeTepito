<?php
    session_start();
    //Aqui se realizara el procesamiento de las variables del carrito, aqui se podran eliminar productos y agregarlos al carrito
    //haciendo uso de variables de sesion para realizar un carrito mas limpio.
    include '../DB_FUNCTIONS/DB_Functions.php';
    include 'ticket.php';
    //variable opcional, la cual nos ayudara si es que queremos enviar alguna alerta al cliente, sobre el estado del producto 
    //agregado al carrito.
   
    //aqui validar para que solo clientes puedan agregar al carrito.

    //tanto los botones de agregar al carrito, como eliminar del carrito, deben de tener este nombre, solo cambiara el valor que lleven
    //Asi tendremos todo esto  ya mas comunicado 
    //$mensaje="IMPRIME DE CARRITO";
    if(isset($_POST['btnAction'])){
        //$mensaje="LLEGO AL BTN";
        switch($_POST['btnAction']){
            case 'Agregar':
                //$mensaje=$mensaje."ENTRO A AGREGAR";
                if(!isset($_SESSION['CARRITO'])){
                    //SOLO MANEJARE ESTOS ATRIBUTOS DEL PRODUCTO YA QUE NO QUIERO GUARDAR TODO EL REGISTRO COMPLETO EN LA VARIABLE
                    //DE SESION, CREO QUE ES MEJOR SOLO TOMAR LOS ATRIBUTOS QUE SERVIRAN PARA LAS CUENTAS Y PARA IDENTIFICAR EL PRODUCTO
                    //CUANDO SE VEA EL DETLLE DE COMPRA, AHI SE DEBEN DE MOSTRAR TOODOS LOS DATOS
                    $producto=especific_product($_POST['ID']);
                    $prod=array(
                        'ID'=>$_POST['ID'],
                        'NOMBRE'=>$producto['nombre'],
                        'DESC'=>$producto['detalles'],
                        'PRECIO'=>doubleval($producto['precio']),
                        'CANT'=>intval($_POST['CANT']),
                        'TALLA'=>$_POST['talla']
                    );
                    $_SESSION['CARRITO'][0]=$prod;
                    //$mensaje=$mensaje."PRODUCTO AGREGADO";
                    echo "<script>alert('PRODUCTO AGREGADO')</script>";
                }else{
                    $id_prods=array_column($_SESSION['CARRITO'],'ID');
                
                    if(in_array($_POST['ID'],$id_prods)){
                        //Aqui podemos decididir si enviarle una alerta al usuario o simplemente agregarlo doble al carrito.
                        //las alertas que puse se pueden borrar ya que no se requieren.
                        $obj=null;
                        $keyy=null;

                        $ob2=null;
                        $keey2=null;
                        foreach($_SESSION['CARRITO'] as $key=>$prod){
                            if($prod['ID']==$_POST['ID'] && $prod['TALLA']==$_POST['talla'] ){
                                $obj=$prod;
                                $keyy=$key;
                                $obj['CANT']=intval($obj['CANT'])+intval($_POST['CANT']);
                                $_SESSION['CARRITO'][$keyy]=$obj;
                                echo "<script>alert('SE HA ACTUALIZADO LA CANTIDAD')</script>";
                                break;
                            }
                            /*if($prod['ID']==$_POST['ID'] && $prod['TALLA']!=$_POST['talla']){
                                $ob2=$prod;
                                $keey2=$key;
                            }*/
                        }
//corregir esto hijo de la verga 
                        if($obj==null){
                            $num_prods=count($_SESSION['CARRITO']);
                            $producto=especific_product($_POST['ID']);
                            
                                $produ=array(
                                    'ID'=>$_POST['ID'],
                                    'NOMBRE'=>$producto['nombre'],
                                    'DESC'=>$producto['detalles'],
                                    'PRECIO'=>doubleval($producto['precio']),
                                    'CANT'=>intval($_POST['CANT']),
                                    'TALLA'=>$_POST['talla']
                                );
                                $_SESSION['CARRITO'][$num_prods]=$produ;
                                echo "<script>alert('PRODUCTO AGREGADO')</script>";
                                
                        }
                           
                            
                        
                            //echo "<script>alert('YA NO HAY MAS EN STOCK')</script>";//si se termina el stock entonces envia este mensaje
                        
                        //echo "<script>alert('El producto ya ha sido agregado')</script>";
                        //$mensaje="";
                    }else{
                        //Aqui se agrega un producto nuevo.
                        $num_prods=count($_SESSION['CARRITO']);
                        $producto=especific_product($_POST['ID']);
                        $prod_stoc=product_stock($_POST['ID'],$_POST['talla']);

                       
                            $prod=array(
                                'ID'=>$_POST['ID'],
                                'NOMBRE'=>$producto['nombre'],
                                'DESC'=>$producto['detalles'],
                                'PRECIO'=>doubleval($producto['precio']),
                                'CANT'=>intval($_POST['CANT']),
                                'TALLA'=>$_POST['talla']
                            );
                            $_SESSION['CARRITO'][$num_prods]=$prod;
                            echo "<script>alert('PRODUCTO AGREGADO')</script>";
                        
                    }
                }
                break;
            case 'Eliminar':
                if(is_numeric($_POST['ID'])){
                    foreach($_SESSION['CARRITO'] as $indice=>$prod){
                        if($prod['ID']==$_POST['ID'] && $prod['TALLA']==$_POST['TALLA']){
                            unset($_SESSION['CARRITO'][$indice]);
                            echo "<script>alert('elemento eliminado');</script>";
                        }
                    }
                }
                break;
            
            case 'Comprar':
                //AQUI FALTA HACER LA COMPRA

                if(isset($_SESSION['CARRITO'])){
                    //Aqui la idea que traia el mena de mandar el pantallazo y el correo al admin

                    
                    //Aqui ingresaremos la compra a la BD
                    $compra=new_sale($_SESSION['client_on'],$_POST['total']);

                    $cliente=select_user($_SESSION['client_on']);
                    //Aqui se ingresaran todos los productos que se compraron
                    $b=true;
                    //echo $compra; 
                    foreach ($_SESSION['CARRITO'] as $key => $prod) {
                        # code...
                        if(new_sale_detail($compra,$prod['ID'],$prod['CANT'],$prod['TALLA'])){
                            actualiza_stock($prod['ID'],$prod['TALLA'],$prod['CANT']);
                            $b=true;
                        }else{
                            $b=false;
                        }

                    }

                    if($b){
                        $compr=get_sale($compra);
                        //compra registrada exitosamente
                        sendMail($cliente['email'],$compra,$_POST['total']);
                        $admin=select_sales_admin();
                        $data=array(
                            "USERNAME" =>$cliente['username'],
                            "ID_COMPRA"=>$compra,
                            "TOTAL"=>$_POST['total'],
                            "FECHA"=>$compr['fecha_compra']
                        );
                        sendMailAdmin($admin['email'],$data);
                        //unlink('../api/Captura.png');
                        unset($_SESSION['CARRITO']);
                    }else{
                        //nah
                    }
                }
               
                break;
            
            case 'mas':
                $ID=$_POST['ID'];
                if($_POST['ID']){
                    $op=null;
                    $ke=null;
                    foreach($_SESSION['CARRITO'] as $indice=>$prod){
                        if($prod['ID']==$ID && $prod['TALLA']==$_POST['TALLA']){
                            $stock=product_stock($prod['ID'],$prod['TALLA']);
                            if(intval($prod['CANT']) < intval($stock['STOCK'])){
                                $prod['CANT']=intval($prod['CANT'])+1;
                                //echo intval($prod['CANT'])+1;
                                $op=$prod;
                                $ke=$indice;
                                $_SESSION['CARRITO'][$ke]=$op;
                                //echo $prod['CANT'];
                            }else{
                                //echo "no mms";
                            }
                        }
                    }
                    //$_SESSION['CARRITO'][$ke]=$op;

                }
                break;
    
            case 'menos':
               $ID=$_POST['ID'];
                if($_POST['ID']){
                    $op=null;
                    $ke=null;
                    foreach($_SESSION['CARRITO'] as $indice=>$prod){
                        if($prod['ID']==$ID && $prod['TALLA']==$_POST['TALLA']){
                            
                            if (intval($prod['CANT'])>1) {
                                $prod['CANT']=intval($prod['CANT'])-1;
                                $op=$prod;
                                $ke=$indice;
                                $_SESSION['CARRITO'][$ke]=$op;
                            }else{
                                //echo "nelson";
                            }
                            //echo "<script>alert('elemento QUITADO');</script>";
                        }
                    }
                }
            break;
            
        }
    }
?>
