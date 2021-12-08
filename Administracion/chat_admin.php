<?php
   include 'crud_admin.php';

    if(isset($_SESSION['admin_on'])){
        //ENSEGUIDA METERLE ESTILOS PARA QUE SE VEA BONITO.

        if($_POST){
            if($_POST['btnActionUs']){
                switch($_POST['btnActionUs']){
                    case 'Responder':
                        header('location:../Chat/chat.php?chat='.$_POST['id_us']);
                        break;
                    case 'Eliminar':
                        if(del_chat($$_POST['id_us'])){
                            echo "<script>alert('Se elimino el chat del usuario ".$_POST['id_us']."')</script>";
                        }else{
                            echo "<script>alert('FALLO')</script>";
                        }
                        
                        break;
                }
            }
        }
?>

<!DOCTYPE html> 
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Liverpuri Official</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../CSS/resp.css?v=<?php echo time(); ?>">
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
                    <li><a href="index_admin.php">Admin</a></li>
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
                        <h3><?php echo $usera['username'] ;?></h3>
                        <br><br>
                        <p><?php echo $usera['p_nombre']." ".$usera['ape_pat'] ?></p>
                        <p><?php echo $usera['email']?></p>
                        <p><?php echo $usera['telefono']?></p>
                    </div>
            </div>
            <div class="usuarios" id="uID">
                <?php
               
                    $clientes=chats_disponibles();
                    foreach ($clientes as $us) {
                        # code...
                ?> 
                    <div class="item-box">
                        <form action="" method="POST">
                            <div class="img-item">
                                <img class="imgi" src="../img/chat.png" alt="item1">
                            </div><!--El boton de añadir cada producto al carrito, metelo dentro de un formulario-->
                            <div class="description">
                                <h4 name="nombre"><?php echo $us['username']?></h4>
                                <p name="ID">ID<?php echo $us['Id_usuario']?></p>
                                <div>
                                    <input type="hidden" name="id_us" value="<?php echo $us['Id_usuario']?>">
                                    <input type="hidden" name="tipo" value="cl">
                                    <button class="update" name="btnActionUs" value="Responder">Responder</button>
                                    <button class="update" name="btnActionUs" value="Eliminar">Borrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
<?php
    } else {
        header("Location: ../index.php");
    }
?>