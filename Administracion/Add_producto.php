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
            ?>
        <div class="home-grid">
            <div class="regist">
                <div class="form-regist">
                <form method="POST" action="">
                        <h1> Editar Producto </h1>
                        <div class="input-group">
                            <label> Nombre </label>
                            <input type="text" name="nombre" autocomplete="off"  required >
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Marca </label>
                                <input type="text" name="marca" autocomplete="off" required>
                            </div>
                            <div class="input-group">
                                <label> Tipo </label>
                                <select name="tipo" required>
                                    <option value="no">Seleccione uno...</option>
                                    <option value="playera">Playeras</option>
                                    <option value="pantalon">Pantalones</option>
                                    <option value="chamarra">Chamarras</option>
                                    <option value="Sudadera">Sudaderas</option>
                                    <option value="abrigo">Abrigos</option>
                                </select>                            
                            </div>    
                        </div>
                        <div class="input-group">
                            <label> Fecha de Lanzamiento </label>
                            <input type="date" name="nuevos"  required>
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Categoria </label>
                                <select name="categoria" required>
                                    <option value="">Elije categoria</option>
                                    <option value="hombre">Hombre</option>
                                    <option value="mujer">Mujer</option>
                                    <option value="ninos">Kids</option>
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
                        <div class="input-group">
                            <label> Talla XL </label>
                            <input type="text" name="XL"  required>
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> URL IMG-1 </label>
                                <input type="text" name="img1" autocomplete="off"  required>
                            </div>
                            <div class="input-group">
                                <label> URL IMG-2 </label>
                                <input type="text" name="img2" autocomplete="off" required>
                            </div>    
                        </div>
                        <div class="input-group">
                            <label> URL IMG-3 </label>
                            <input type="text" name="img3"  required>
                        </div>
                        <div class="input-group">
                            <label> Estatus </label>
                            <input type="text" name="status"  required>
                        </div>
                        <input type="hidden" name="tipo" value="p">
                        <button type="submit" name="btnAction" class="sign-in" id="new-user" value="Guardar"> Guardar </button>
                    </form>    
<?php
        }elseif($_POST && isset($_SESSION['admin_on'])){
            $tallas='{"XS":'.$_POST['XS'].',"S":'.$_POST['S'].',"M":'.$_POST['M'].',"L":'.$_POST['L'].',"XL":'.$_POST['XL'].'}';
            $ims='{"I1":"'.$_POST['img1'].'", "I2":"'.$_POST['img2'].'","I3":"'.$_POST['img3'].'"}';
            $prod_daaaa=array();
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
            $prod_daaaa+=["status"=> $_POST['status']];
        
            if(insert_product($prod_daaaa)){
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