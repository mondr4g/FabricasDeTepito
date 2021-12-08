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
                <li><a href="catalogo.php?categoria=hombre">Hombre</a></li>
                <li><a href="catalogo.php?categoria=mujer">Mujer</a></li>
                <li><a href="catalogo.php?categoria=ninos">Niño/a</a></li>
                <li><a href="catalogo.php?rebajas=true">Rebajas</a></li>
                <?php
                    if (isset($_SESSION['admin_on'])) {      
                ?>
                    <li><a href="../Administracion/index_admin.php">Admin</a></li>
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
            <div class="filter" onchange="getFilter()">
                    <div id="category">
                        <?php 
                            if(isset($_GET['categoria']))
                                echo "<input type='text' id='cat' value='" . $_GET['categoria'] . "'>";
                            else
                                echo "<input type='text' id='cat'>";  
                        ?>
                    </div>
                    <div id="rebajas">
                        <?php 
                            if(isset($_GET['rebajas']))
                                echo "<input type='text' id='reb' value='" . $_GET['rebajas'] . "'>";
                            else
                                echo "<input type='text' id='reb'>"; 
                        ?>
                    </div>
                    <div id="newLanz">
                        <?php 
                            if(isset($_GET['nuevos']))
                                echo "<input type='text' id='nLanz' value='" . $_GET['nuevos'] . "'>";
                            else
                                echo "<input type='text' id='nLanz'>"; 
                        ?>
                    </div>
                    <div class="input-group">
                        <h3>Articulo</h3>
                        <input type="checkbox" value="Playera" id="playera" name="playera"> Playeras <br>
                        <input type="checkbox" value="Pantalon" id="pantalon" name="pantalon"> Pantalones <br>
                        <input type="checkbox" value="Chamarra" id="chamarra" name="chamarra"> Chamarras <br>
                        <input type="checkbox" value="Sudadera" id="sudadera" name="sudadera"> Sudaderas <br>
                        <input type="checkbox" value="Abrigo" id="abrigo" name="abrigo"> Abrigos <br>
                    </div>
                    <br>
                    <div class="input-group">
                        <h3>Talla</h3>
                        <input type="checkbox" value="XS" id="xs" name="xs"> XS <br>
                        <input type="checkbox" value="S" id="s" name="s"> S <br>
                        <input type="checkbox" value="M" id="m" name="m"> M <br>
                        <input type="checkbox" value="L" id="l" name="l"> L <br>
                        <input type="checkbox" value="XL" id="xl" name="xl"> XL <br>
                    </div>
                    <br>
                    <div class="input-group">
                        <h3>Precio Minimo</h3>
                        $100 <input type="range" id="iprice" name="initial_price" min="100" max="3100" list="tickmarks" value="100" step="500" onchange="imaxPrice()"> <label id="imaxPrice">$100</label><br><br>
                        <h3>Precio Maximo</h3>
                        $100 <input type="range" id="fprice" name="final_price" min="100" max="3100" list="tickmarks" value="3100" step="500" onchange="fmaxPrice()"> <label id="fmaxPrice">$3100</label><br>
                        <datalist id="tickmarks">
                            <option value="100">
                            <option value="600">
                            <option value="1100">
                            <option value="1600">
                            <option value="2100">
                            <option value="2600">
                            <option value="3100">
                        </datalist>
                    </div>
            </div>
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
                        foreach ($productos as $prod) {
                            # code...
                            $imgs=json_decode($prod['imgs']); ?> 
                            <div class="item-box">
                                <form action="" method="POST">
                                    <div class="img-item">
                                        <a href="vista_producto.php?id_del_prod=<?php echo $prod['ID_producto'] ?>"><img class="imgi" src="<?php echo $imgs->I1 ?>" alt="item1"></a> 
                                    </div>
                                    <div class="description">
                                        <h4 name="nombre"><?php echo $prod['nombre']?></h4>
                                        <p name="precio"><?php echo $prod['precio']?> $MXN</p>
                                        <div class="info-item">
                                            <input type="hidden" name="nombre" value="<?php echo $prod['nombre']?>">
                                            <input type="hidden" name="precio" value="<?php echo $prod['precio']?>">
                                            <input type="hidden" name="ID" value="<?php echo $prod['ID_producto'] ?>">
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