<?php
    
    include '../Carrito/carrito.php';

    //Aqui agregaremos lo del catalogo de los productos
?>
<!DOCTYPE html> 
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Liverpuri Official</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../CSS/resp.css?v=<?php echo time(); ?>">
    <script type="text/javascript" src="../JS/catalog.js?v=<?php echo time(); ?>"></script>
</head>
<body>
	<header>
        <nav>
            <a id="main-logo" href="../index.php"><h1 class="logo">LiverPuri</h1></a>
            <input type="checkbox" id="hamburguer-toggle">
            <label for="hamburguer-toggle" class="hamburguer">
                <span class="bar"></span>
            </label>
            <ul class="nav-list">
                <li><a href="catalogo.php?nuevos=true">Nuevos Lanzamientos</a></li>
                <li><a href="catalogo.php?categoria=Hombre">Hombre</a></li>
                <li><a href="catalogo.php?categoria=Mujer">Mujer</a></li>
                <li><a href="catalogo.php?categoria=Ninos">Niño/a</a></li>
                <li><a href="catalogo.php?rebajas=true">Rebajas</a></li>
                <?php
                    if (isset($_SESSION['admin_on'])) {      
                ?>
                    <li><a href="../Administracion/index_admin.php">Admin</a></li>
                    <li><a href="../Administracion/Estadisticas.php">Estadisticas</a></li>
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
                    <li><a href="../Administracion/chat_admin.php">Chat</a></li>
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
            
            <div class="products" id="prod">
                <?php
                    if(isset($_GET['categoria'])){
                        $productos=products_by_cat($_GET['categoria']);
                    }elseif(isset($_GET['rebajas'])){
                        $productos=get_rebajas();
                    }elseif(isset($_GET['nuevos'])){
                        $productos=get_newProds();
                    }else{
                        $productos=select_all_products();
                    }

                    if ($productos) {
                        while(($prod = oci_fetch_array($productos, OCI_ASSOC)) != false) {
                            # code...
                            $imgs=$prod['RUTA']; ?> 
                            <div class="item-box">
                                <form action="" method="POST">
                                    <div class="img-item">
                                        <a href="vista_producto.php?id_del_prod=<?php echo $prod['ID_PRODUCTO'] ?>"><img class="imgi" src="<?php echo $imgs ?>" alt="item1"></a> 
                                    </div>
                                    <div class="description">
                                        <h4 name="nombre"><?php echo $prod['NOMBRE']?></h4>
                                        <p name="precio"><?php echo $prod['PRECIO']?> $MXN</p>
                                        <div class="info-item">
                                            <input type="hidden" name="nombre" value="<?php echo $prod['NOMBRE']?>">
                                            <input type="hidden" name="precio" value="<?php echo $prod['PRECIO']?>">
                                            <input type="hidden" name="ID" value="<?php echo $prod['COD_PRODUCTO'] ?>">
                                            <input type="hidden" name="CANT" value="1">
                                            <input type="hidden" name="talla" value="M">
                                        </div>
                                        <?php if (isset($_SESSION['admin_on']) || isset($_SESSION['client_on'])) {?>
                                            <button class="buy" name="btnAction" value="Agregar">Add</button>
                                        <?php } ?>
                                    </div>
                                </form>
                            </div>
                <?php
                        }
                    }else{
                        echo("No llega nada");
                ?>
                    <!--Aqui ponle un msj bien vrgas de que no hay-->
                <?php
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