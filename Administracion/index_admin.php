<?php
   include 'crud_admin.php';

    if(isset($_SESSION['admin_on'])){
        //ENSEGUIDA METERLE ESTILOS PARA QUE SE VEA BONITO.
?>

<!DOCTYPE html> 
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Fabricas de Tepito Official</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../CSS/resp.css?v=<?php echo time(); ?>">
    <script type="text/javascript">
        window.onload = function() {
            checkView();
        }

        function checkView() {
            var result = document.getElementsByClassName("switch-input")[0].checked ? 'yes' : 'no';
            console.log(result);
            if(result == 'yes') {
                document.getElementById('uID').style.display = "inline-flex";
                document.getElementById('pID').style.display = "none";
            }
            else {
                document.getElementById('uID').style.display = "none";
                document.getElementById('pID').style.display = "inline-flex";                
            }
        }
    </script>
</head>
<body>
	<header>
        <nav>
            <a id="main-logo" href="../index.php"><h1 class="logo">Fabricas de Tepito</h1></a>
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
                    <li><a href="Estadisticas.php">Estadisticas</a></li>
                <?php
                    }
                ?>
                <?php
                    if (!isset($_SESSION['admin_on']) && !isset($_SESSION['client_on'])) {        
                ?>
                <li><a href="../Sesiones/login.php">Sign in</a></li>
                <?php
                    }
                ?>
                <?php
                    if (isset($_SESSION['admin_on']) || isset($_SESSION['client_on'])) {      
                ?>
                <li><a href="../Sesiones/logout.php">Sing out</a></li>
                <?php
                    }
                ?>
            </ul>
            <a href="../Carrito/mostrar_carrito.php"><img id="shop-car" src="../img/shopping_car.png" alt="shop-car"></a>
        </nav>
	</header>	
	<main>
        <div class="home-grid">
            <div class="info-admin">
                    <div class="img-admin">
                        <img src="../img/user.png" alt="">
                    </div>
                    <div class="data-admin">
                    <?php
                        $usera=get_admin($_SESSION['admin_on']);
                        
                    ?>
                        <h3><?php echo $usera['USERNAME'] ;?></h3>
                        <br><br>
                        <p><?php echo $usera['P_NOMBRE']." ".$usera['APE_PAT'] ?></p>
                        <p><?php echo $usera['EMAIL']?></p>
                        <p><?php echo $usera['TELEFONO']?></p>
                    </div>
                    <div class="toggle-switch">
                        <label class="switch">
                            <input class="switch-input" type="checkbox" onclick="checkView()"/>
                            <span class="switch-label" data-on="Users" data-off="Products"></span> 
                            <span class="switch-handle"></span> 
                        </label>
                    </div>
                    <div class="btn-A">
                    <form action="" method="post">
                        <button type="submit" name="btnAction" value="Add_us"  >Add PERSONA</button><!--Falta este boton xd-->
                        <button type="submit" name="btnAction" value="Add_prod"  >Add Producto</button><!--Falta este boton xd-->
                        <button type="submit" name="btnAction" value="Add_ofer"  >Add Oferta</button><!--Falta este boton xd-->
                        </form>

                    </div>
            </div>
            <div class="products2" id="pID">
                <?php
                    $productos=select_all_products();
                    while(($prod = oci_fetch_array($productos, OCI_ASSOC)) != false) {
                        # code...
                        $imgs = $prod['RUTA'];
                ?> 
                    <div class="item-box">
                        <form action="" method="POST">
                            <div class="img-item">
                                <img class="imgi" src="<?php echo $imgs?>" alt="item1"> 
                            </div><!--El boton de añadir cada producto al carrito, metelo dentro de un formulario-->
                            <div class="description">
                                <h4 name="nombre"><?php echo $prod['NOMBRE']?></h4>
                                <p name="precio">$<?php echo $prod['PRECIO']?></p>
                                <div class="info-item">
                                    <input type="hidden" name="id_prod" value="<?php echo $prod['ID_PRODUCTO'] ?>">
                                </div>
                                <div>
                                    
                                    <button class="update" name="btnActionProd" value="Actualizar">Editar</button>
                                    <button class="update" name="btnActionProd" value="Eliminar">Borrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div class="PERSONAs" id="uID">
                <?php
                    $clientes=select_all_clients();
                    $admins=select_all_admins();
                    while(($us = oci_fetch_array($clientes, OCI_ASSOC)) != false) {
                        # code...
                        $img=null;
                        if(@$us['SEXO']=="H"){
                            $img="../img/hombre.png";//Aqui mete el link de hombre
                        }elseif(@$us['SEXO']=="M"){
                            $img="../img/mujer.png" ;//imagen de mujer
                        }
                ?> 
                    <div class="item-box">
                        <form action="" method="POST">
                            <div class="img-item">
                                <img class="imgi" src="<?php echo $img; ?>" alt="item1">
                            </div><!--El boton de añadir cada producto al carrito, metelo dentro de un formulario-->
                            <div class="description">
                                <h4 name="nombre"><?php echo $us['USERNAME']?></h4>
                                <p name="ID">ID<?php echo $us['ID_PERSONA']?></p>
                                <div>
                                    <input type="hidden" name="id_us" value="<?php echo $us['ID_PERSONA']?>">
                                    <input type="hidden" name="tipo" value="cl">
                                    <button class="update" name="btnActionUs" value="Actualizar">Editar</button>
                                    <button class="update" name="btnActionUs" value="Eliminar">Borrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                    }
                    while(($us = oci_fetch_array($admins, OCI_ASSOC)) != false) {
                        # code...
                        $img="../img/admin.png";//Aqui pon la imagen
                        if ($us['ID_PERSONA']!=$_SESSION['admin_on']) {
                            ?>
                    <div class="item-box">
                        <form action="">
                            <div class="img-item">
                                <img class="imgi" src="<?php echo $img; ?>" alt="item1">
                            </div><!--El boton de añadir cada producto al carrito, metelo dentro de un formulario-->
                            <div class="description">
                                <h4 name="nombre"><?php echo $us['USERNAME']?></h4>
                                <p name="ID">ID<?php echo $us['ID_PERSONA']?></p>
                                <div>
                                    <input type="hidden" name="id_us" value="<?php echo $us['ID_PERSONA']?>">
                                    <input type="hidden" name="tipo" value="ad">
                                    <button class="update" name="btnActionUs" value="Actualizar">Editar</button>
                                    <button class="update" name="btnActionUs" value="Eliminar">Borrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
	</main>
	<footer>
		<p>&copy; 2020 | Drackode | Aguascalientes, Mexico</p>      	
	</footer>
</body>
</html>
<?php
    }
    else {
        header("Location: ../index.php");
    }
?>