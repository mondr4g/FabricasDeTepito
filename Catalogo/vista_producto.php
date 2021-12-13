<?php
    include '../Carrito/carrito.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item View</title>
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
                <li><a href="catalogo.php">Nuevos Lanzamientos</a></li>
                <li><a href="catalogo.php?categoria=hombre">Hombre</a></li>
                <li><a href="catalogo.php?categoria=mujer">Mujer</a></li>
                <li><a href="catalogo.php?categoria=ninos">Niño/a</a></li>
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
        <?php
            if(isset($_GET['id_del_prod'])){
                $prod=especific_product($_GET['id_del_prod']);//recuperar datos del producto
                //$tallas=$prod['TALLA'];//recuperar las tallas
                $img=$prod['RUTA'];     
        ?>
        <div class="home-grid">
            <div class="product-view">
                    <div class="product-img">
                        <img src="<?php echo $img ?>" alt="">
                    </div>
            </div>
            <div class="product-info">
                <form action="" method="post">
                    <h2><?php echo $prod['NOMBRE']; ?></h2>
                    <p>
                        Descripcion: <?php echo $prod['DESCRIPCION']; ?> <br>
                    </p>
                    <br>
                    <h3>$MXN <?php echo $prod['PRECIO']; ?></h3>
                    <div>
                        <!-- Falta validar las tallas existentes, para enviarla al carrito -->
                        <div class="tallas">
                            <h3>Talla</h3>
                            <?php
                                /*while(($key = oci_fetch_array($tallas, OCI_ASSOC)) != false)*/
                                foreach($prod as $key) {
                                    if(intval($key["STOCK"])>0){
                            ?>  
                                    
                                    <input type="radio" value="<?php echo $key["TALLA"] ?>" id="tallas2" name="talla" checked> <?php echo $key ?>
                            <?php
                                    }
                                }
                            ?>
                            <!--
                            <input type="radio" value="XS" id="xs" name="size"> XS 
                            <input type="radio" value="S" id="s" name="size"> S 
                            <input type="radio" value="M" id="m" name="size"> M 
                            <input type="radio" value="L" id="l" name="size"> L 
                            <input type="radio" value="XL" id="xl" name="size"> XL -->
                        </div>
                        <div class="cantidad">
                            <button class="buy" type="button" name="menos" onclick="menosCant()">-</button>
                            <label id="cant" name="cantidad">1</label>
                            <button class="buy" type="button" name="mas" onclick="masCant()">+</button> <br>
                            <span id="msgCant"></span>
                        </div>
                        <br>
                        <?php
                            //echo $mensaje; 
                            if(isset($_SESSION['admin_on']) || isset($_SESSION['client_on'])){?>
                            <input type="hidden" name="ID" id="ID" value="<?php echo $prod['ID_PRODUCTO']?>">
                            <input type="hidden" name="CANT" id="CANT"><!--Me falta sacar este valor, del label de arriba no se como xdxd-->
                            <button class="buy" type="submit" name="btnAction" id="btnAction" value="Agregar">Add</button>
                        <?php }?>
                    </div>
                </form>
            </div>
            <div class="fyp">
            <?php
                if (isset($_SESSION['client_on'])) {
                    $fyp = prods_relacionados($_SESSION['client_on']);
                    if($fyp)  {
                        while(($fyprod = oci_fetch_array($fyp, OCI_ASSOC)) != false) {
                            # code... 
                            $imags=$fyprod['RUTA'];
                            ?>
            
                <div class="item-box">
                    <form action="" method="POST">
                        <div class="img-item">
                            <a href="vista_producto.php?id_del_prod=<?php echo $fyprod['ID_PRODUCTO'] ?>"><img class="imgi" src="<?php echo $imags->I1 ?>" alt="item1"></a> 
                        </div>
                        <div class="description">
                            <h4 name="nombre"><?php echo $fyprod['NOMBRE']?></h4>
                            <p name="precio"><?php echo $fyprod['PRECIO']?> $MXN</p>
                            <div class="info-item">
                                <input type="hidden" name="nombre" value="<?php echo $fyprod['NOMBRE']?>">
                                <input type="hidden" name="precio" value="<?php echo $fyprod['PRECIO']?>">
                                <input type="hidden" name="ID" value="<?php echo $fyprod['ID_PRODUCTO'] ?>">
                                <input type="hidden" name="CANT" value="1">
                                <input type="hidden" name="talla" value="M">
                            </div>
                        </div>
                    </form>
                </div>
            
            <?php
                        }
                    }
                }
            ?>
            </div>
            <div class="product-comments">
                <h2 id="title-comment">Comentarios</h2>
                <!--Por aqui ponle el formulario para los comentarios--->
                <?php
                    if (isset($_SESSION['admin_on']) || isset($_SESSION['client_on'])) {
                ?>
                <div class="new-comment">
                    <form method="POST">
                        <label for="newcomment">Agrega tu comentario.</label><br>
                        <textarea name="newComment" id="newCommentario" cols="30" rows="10"></textarea>
                        <input type="hidden" name="id_prod" id="id_prod" value="<?php echo $_GET['id_del_prod']?>">
                        <button class="buy" type="button" name="btnAction" value="Enviar" onclick="getRequestComment()">Enviar</button>
                    </form>
                </div>
                <?php
                    }
                ?>
                <div id="comentarios">
                <?php
                    $coments=select_coments_by_product($_GET['id_del_prod']);
                    if($coments){
                        while(($com = oci_fetch_array($coments, OCI_ASSOC)) != false) {
                            $user=select_user($com['ID_CLIENTE']); ?>
                            <div class="comentario">
                                <div class="info-comment">
                                    <p>Por: <?php echo $user['USERNAME']?> </p>
                                    <p><?php echo $com['FECHA']?></p>
                                </div>
                                <br>
                                <div class="desc-comment">
                                    <p><?php echo $com['COMENTARIO']?></p>
                                </div>
                                <hr>    
                            </div>
                <?php
                        }
                    }else{
                ?>
                    <!-- Aqui ponle un msj mamalon de que no hay coments -->        
                <?php
                    }
                ?>
                </div>
            </div>
            <?php }else{

                }
            ?>

        </div>
	</main>
	<footer>
		<p>&copy; 2020 | Drackode | Aguascalientes, Mexico</p>      	
	</footer>
</body>
</html>
