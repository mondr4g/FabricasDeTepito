<?php
    //Aqui estoy incluyendo el codigo que realiza el manejo del carrito.
    include 'carrito.php';
?>

<!-- Aqui pones html-->
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
                <li><a href="../Catalogo/catalogo.php?nuevos=true">Nuevos Lanzamientos</a></li>
                <li><a href="../Catalogo/catalogo.php?categoria=hombre">Hombre</a></li>
                <li><a href="../Catalogo/catalogo.php?categoria=mujer">Mujer</a></li>
                <li><a href="../Catalogo/catalogo.php?categoria=ninos">Niño/a</a></li>
                <li><a href="../Catalogo/catalogo.php?rebajas=true">Rebajas</a></li>
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
            <a href="#contact"><img id="shop-car" src="../img/shopping_car.png" alt="shop-car"></a>
        </nav>
    </header>
    <main>
        <div class="home-grid" id="captura">  	
    <?php
        //aqui es para validar si hay algo en el carrito, los ID's de los productos vienen aqui.
        if(isset($_SESSION['CARRITO'])){
            
    ?>
        

            <?php
                //variable para el total
                $total=0;
                $band=true;
                //aqui recorremos el carrito.
                foreach ($_SESSION['CARRITO'] as $indice=>$prod) {
                    //en esta variable esta toda la info de cada producto en el carrito, ya que la obtuve mediente un query a la base de datos
                    //Esta la podemos eliminar, pero la puse, por ejemplo por si quieres mostrar como un detalle de compra y aqui estan todos los datos del registro.
                    $producto=especific_product($prod['ID']);
                    $img=json_decode($producto['imgs']);
                    $stock=product_stock($prod['ID'],$prod['TALLA']);
                    

            ?>
            <!-- Aqui puedes meter para mostrar los productos, para ponerle acciones a cada producto osea como botones de eliminar, o modificar la cantidad
                a todos llamaslos btnAccion, y en el value le pones otro diferente, por ejemplo "cant_menos"..etc o que se yo xd 
                de cajon es un formulario POST que envie a esta misma pagina. Con que envies el puro ID ya sea para eliminar o modificar cantidad o eliminar el producto del carrito-->
                <div class="product-view">
                    <div class="product-img2">
                        <img src="<?php echo $img->I1 ?>" alt="">
                    </div>
                </div>
            <div class="product-info2">
                <form id="view-car" action="" method="post">
                    <div>
                        <h2><?php echo $producto['nombre']; ?></h2>
                        <p>
                            Descripcion: <?php echo $producto['detalles']; ?> <br>
                        </p>
                        <br>
                        <h3>$MXN <?php echo $producto['precio']; ?></h3>
                        <div class="tallas">
                            <h3>Talla: <?php echo $prod['TALLA'];?></h3>
                        </div>
                    </div>
                    <div>
                        <!-- Falta validar las tallas existentes, para enviarla al carrito -->
                        <?php
                            if($prod['CANT']>$stock['STOCK']){
                                $band=false;
                                echo "Por el momento solo hay ".$stock['STOCK']." piezas en stock";
                            }elseif($band==false && $prod['CANT']<= $stock['STOCK']){
                                $band=true;
                            }

                            if($prod['CANT'] == 0)
                                $prod['CANT'] = 1;
                        ?>
                        <div class="cantidad">
                            <button class="buy2" type="submit" name="btnAction" value="menos">-</button>
                            <label id="cant2" name="cantidad"><?php echo $prod['CANT']?></label>
                            <button class="buy2" type="submit" name="btnAction" value="mas">+</button> <br>
                            <span id="msgCant"></span>
                        </div>
                        <br>
                        
                            <input type="hidden" name="ID" id="ID" value="<?php echo $prod['ID']?>">
                            <input type="hidden" name="TALLA" id="TALLA" value="<?php echo $prod['TALLA']?>">
                            <button class="buy2" type="submit" name="btnAction" value="Eliminar">Eliminar</button>
                    </div>
                
                </form>
            </div>

            <?php
                    //Aqui se hace la suma o cuenta del total
                    $total+=intval($prod['CANT'])*doubleval($prod['PRECIO']);
                    
                }
                if($band){
            ?>
                <div class="confirm">
                    <form action="" method="post">
                            <P><b>TOTAL: </b>$MXN <?php echo $total ?>.00</p>
                            <input type="hidden" name="total" value="<?php echo $total ?>">
                            <button type='submit' name='btnAction' id="compra" value='Comprar' onclick="send()">Comprar</button>
                    </form>
                </div>
            <?php

                }
            ?>
        
    <?php
        }else{
    ?>
    <!-- Aqui para mostrar algun mensaje o lo que sea, para cuando no hayan elementos agregados al carrito -->
    <div class="empty">
        <p>No hay productos en el carrito . . . . . .</p>
    </div>
    <?php
        }
    ?>
    </div>
    </main>
	<footer>
		<p>&copy; 2020 | Drackode | Aguascalientes, Mexico</p>      	
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="../JS/script.js?v=<?php echo time(); ?>"></script>
    <!-- https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js  nueva-->

    <!-- https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js fea-->
</body>
</html>