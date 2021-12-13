<?php
    session_start();
    include '../DB_FUNCTIONS/DB_functions.php';
    if (isset($_SESSION['admin_on'])) {
?>
<!DOCTYPE html> 
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Liverpuri Official</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../CSS/log.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../CSS/resp.css?v=<?php echo time(); ?>">
</head>
<body>
	<header>
        <nav style="background-color: transparent">
            <a id="main-logo" href="../index.php"><h1 style="color: black" class="logo">LiverPuri</h1></a>
            <input type="checkbox" id="hamburguer-toggle">
            <label for="hamburguer-toggle" class="hamburguer">
                <span class="bar"></span>
            </label>
            <ul class="nav-list">
                <li><a href="../Catalogo/catalogo.php?nuevos=true">Nuevos Lanzamientos</a></li>
                <li><a href="../Catalogo/catalogo.php?categoria=hombre">Hombre</a></li>
                <li><a href="../Catalogo/catalogo.php?categoria=mujer">Mujer</a></li>
                <li><a href="../Catalogo/catalogo.php?categoria=ninos">Niño/a</a></li>
                <li><a href="../Catalogo/catalogo.php?rebajas=true">Rebajas</a></li>
                <?php
                    if (isset($_SESSION['admin_on'])) {
                        ?>
                    <li><a href="index_admin.php">Admin</a></li>
                    <li><a href="Estadisticas.php">Estadisticas</a></li>
                <?php
                    } 
                ?>
                <?php
                    if (isset($_SESSION['client_on'])) {      
                ?>
                    <li><a href="../Chat/chat.php">Chat</a></li>
                <?php
                    }
                ?>
                <?php
                    if (isset($_SESSION['admin_on'])) {      
                ?>
                    <li><a href="chat_admin.php">Chat</a></li>
                <?php
                    }
                ?>
                <?php
                    if (!isset($_SESSION['admin_on']) && !isset($_SESSION['client_on'])) {
                        ?>
                <li><a href="../Sesiones/login.php">Sign in</a></li>
                <?php
                    } ?>
                <?php
                    if (isset($_SESSION['admin_on']) || isset($_SESSION['client_on'])) {
                        ?>
                <li><a href="../Sesiones/logout.php">Sing out</a></li>
                <?php
                    } ?>
            </ul>
            <a href="../Carrito/mostrar_carrito.php"><img id="shop-car" src="../img/shopping_car.png" alt="shop-car"></a>
        </nav>
	</header>	
	<main>
    <?php
        if (!$_POST) {
            $CATST = get_all_categories();
            $MARCS = get_all_marcas();

            ?>
        <div class="home-grid">
            <div class="regist">
                <div class="form-regist">
                <form method="POST" action="">
                        <h1> Agregar Producto </h1>
                        <div class="input2">
                            <div class="input-group">
                                <label> Nombre </label>
                                <input type="text" name="nombre" autocomplete="off"  required >
                            </div>
                            <div class="input-group">
                                <label> Descripcion </label>
                                <input type="text" name="descrip" autocomplete="off"  required >
                            </div>
                        </div>
                        
                        <div class="input2">
                            <div class="input-group">
                                <label> Marca </label>
                                <select name="marca" required>
                                    <option value="no">Seleccione uno...</option>
                                    <?php
                                        while(($row = oci_fetch_array($MARCS, OCI_ASSOC)) != false) {
                                    ?>
                                        <option value="<?php echo $row["ID_MARCA"]; ?>"><?php echo $row["NOMBRE"]; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>                            
                            </div>
                            <div class="input-group">
                                <label> Fecha de Lanzamiento </label>
                                <input type="date" name="fecha_lan"  required>
                            </div>    
                        </div>
                        
                        <div class="input2">
                            <div class="input-group">
                                <label> Categoria </label>
                                <select name="categoria" required>
                                    <option value="">Elije categoria</option>
                                    <?php
                                        while(($row = oci_fetch_array($CATST, OCI_ASSOC)) != false) {
                                    ?>
                                            <option value="<?php echo $row["NOMBRE"]; ?>"><?php echo $row["NOMBRE"]; ?></option>
                                    <?php
                                        }
                                    ?>

                                <!---$_COOKIE
                                    <option value="mujer">Mujer</option>
                                    <option value="ninos">Kids</option>
                                -->
                                    
                                </select> 
                            </div>
                            <div class="input-group">
                                <label> Precio </label>
                                <input type="text" name="precio" autocomplete="off"  required>
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Talla XS </label>
                                <input type="text" name="XS" autocomplete="off"  required>
                            </div>
                            <div class="input-group">
                                <label> Talla S </label>
                                <input type="text" name="S" autocomplete="off" required>
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Talla M </label>
                                <input type="text" name="M" autocomplete="off"  required>
                            </div>
                            <div class="input-group">
                                <label> Talla L </label>
                                <input type="text" name="L" autocomplete="off"  required>
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Talla XL </label>
                                <input type="text" name="XL"  required>
                            </div>
                            <div class="input-group">
                                <label> Talla XXL </label>
                                <input type="text" name="XL"  required>
                            </div>
                        </div>
                        
                        <div class="input2">
                            <div class="input-group">
                                <label> URL IMAGEN </label>
                                <input type="text" name="img1" autocomplete="off"  required>
                            </div>
                            <div class="input-group">
                                <label> Estatus </label>
                                <select name="status" required>
                                    <option value="no">Seleccione uno...</option>
                                    <option value="Y">ACTIVO</option>
                                    <option value="N">INACTIVO</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="tipo" value="p">
                        <button type="submit" name="btnAction" class="sign-in" id="new-user" value="Guardar"> Guardar </button>
                    </form>    
<?php
        }elseif($_POST && isset($_SESSION['admin_on'])){
            
            /*IMAGENES
            [
                {
                    "titulo":" ",
                    "ruta":" ",
                    "descripcion":" "
                }
            ] 
            */

            /*STOCK DE TALLAS
            [
                {
                    "stock":" ",
                    "talla" : " ",
                    "precio" : " ",
                }
             ]   
            */
            $prec = $_POST['precio'];
            $tallas = '
                [
                    {
                        "stock":"'.$_POST['XS'].'",
                        "talla" : "XS",
                        "precio" : "'.$prec.'"
                    },
                    {
                        "stock":"'.$_POST['S'].'",
                        "talla" : "S",
                        "precio" : "'.$prec.'"
                    },
                    {
                        "stock":"'.$_POST['M'].'",
                        "talla" : "M",
                        "precio" : "'.$prec.'"
                    },
                    {
                        "stock":"'.$_POST['L'].'",
                        "talla" : "L",
                        "precio" : "'.$prec.'"
                    },
                    {
                        "stock":"'.$_POST['XL'].'",
                        "talla" : "XL",
                        "precio" : "'.$prec.'"
                    }
                ]
            ';
            
            $ims='
                [
                    {
                        "titulo":"Imagen X",
                        "ruta":"'.$_POST['img1'].'", 
                        "descripcion":"una imagen mas."
                    }
                ]';
            
            
            $cats = '["'.$_POST['categoria'].'"]';
            $new_prod_data = array(
                "nombre" => $_POST['nombre'],
                "descrip" => $_POST['descrip'],
                "marca" => $_POST['marca'],
                "cate" => $cats,
                "talls" => $tallas,
                "imgs" => $ims
            );
            
            /*$prod_daaaa=array();
            $prod_daaaa+=["id"=>$_POST['id_us']];
            $prod_daaaa+=["nombre" => $_POST['nombre']];
            $prod_daaaa+=["detalles" => $_POST['detalles']];
            $prod_daaaa+=["precio" => $_POST['precio']];
            $prod_daaaa+=["marca" => $_POST['marca']];
            $prod_daaaa+=["tipo" => $_POST['tipo']];
            $prod_daaaa+=["tallas" => $tallas];
            $prod_daaaa+=["categoria" => $_POST['categoria']];
            $prod_daaaa+=["fecha" => $_POST['fecha_lan']];
            $prod_daaaa+=["imgs" => $imgs];
            $prod_daaaa+=["status"=> $_POST['status']];*/
        
            if(insert_product($new_prod_data)){
                //muestra confirmacion de que si se logro el update
                header('location:index_admin.php');
            }else{
                //No se logro
                echo "error";
            }
        }
            
        
    
    
?>
                </div>
            </div>
		</div>	
    </main>
    <footer>
        <p>&copy; 2020 | Drackode | Aguascalientes, Mexico</p>      	    
    </footer>
</body>
</html>


<?php
    }   else {
        header("Location: ../index.php");
    }
?>