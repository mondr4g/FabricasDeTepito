<?php
    session_start();
?>
<!DOCTYPE html> 
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Liverpuri Official</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="CSS/resp.css?v=<?php echo time(); ?>">
</head>
<body>
	<header>
        <nav>
            <h1 class="logo">LiverPuri</h1>
            <input type="checkbox" id="hamburguer-toggle">
            <label for="hamburguer-toggle" class="hamburguer">
                <span class="bar"></span>
            </label>
            <ul class="nav-list">
                <li><a href="Catalogo/catalogo.php?nuevos=true">Nuevos Lanzamientos</a></li>
                <li><a href="Catalogo/catalogo.php?categoria=hombre">Hombre</a></li>
                <li><a href="Catalogo/catalogo.php?categoria=mujer">Mujer</a></li>
                <li><a href="Catalogo/catalogo.php?categoria=ninos">Niño/a</a></li>
                <li><a href="Catalogo/catalogo.php?rebajas=true">Rebajas</a></li>
                <?php
                    if (isset($_SESSION['admin_on'])) {      
                ?>
                    <li><a href="Administracion/index_admin.php">Admin</a></li>
                <?php
                    }
                ?>
                <?php
                    if (isset($_SESSION['client_on'])) {      
                ?>
                    <li><a href="Chat/chat.php">Chat</a></li>
                <?php
                    }
                ?>
                <?php
                    if (isset($_SESSION['admin_on'])) {      
                ?>
                    <li><a href="Administracion/chat_admin.php">Chat</a></li>
                <?php
                    }
                ?>
                <?php
                    if (!isset($_SESSION['admin_on']) && !isset($_SESSION['client_on'])) {        
                ?>
                <li><a href="Sesiones/login.php">Sign in</a></li>
                <?php
                    }
                ?>
                <?php
                    if (isset($_SESSION['admin_on']) || isset($_SESSION['client_on'])) {      
                ?>
                <li><a href="Sesiones/logout.php">Sing out</a></li>
                <?php
                    }
                ?>
            </ul>
            <a href="Carrito/mostrar_carrito.php"><img id="shop-car" src="img/shopping_car.png" alt="shop-car"></a>
        </nav>
	</header>	
	<main>
		<div class="home-grid">
            <div class="slide">
                <div class="slogan">
                    <h1>LIVERPURI es parte de mi vida!</h1>
                    <button>Shop Now</button>
                </div>
            </div>

            <div class="container">
                <div class="info">
                    <h1>Nuevos Lanzamientos</h1>
                    <p>
                        No te pierdas los nuevos lanzamientos <br>
                        de temporada.
                    </p>
                    <button><a href="Catalogo/catalogo.php?nuevos=true">Nuevos Lanzamientos</a></button>
                </div>
                <div class="img-cont">
                    <img src="img/new.jpg" alt="new">
                </div>    
            </div>

            <div class="container2">
                <div class="title-box">
                    <h1>Ropa para toda la familia</h1>
                </div>
                <div class="container-box">
                    <div class="card">
                        <img src="img/men.jpg" alt="Hombres">
                        <a href="Catalogo/catalogo.php?categoria=hombre"><p>Hombre</p></a> 
                    </div>
                    <div class="card">
                        <img src="img/women.jpg" alt="Mujeres">
                        <a href="Catalogo/catalogo.php?categoria=mujer"><p>Mujer</p></a> 
                    </div>
                    <div class="card">
                        <img src="img/kids.jpg" alt="Kids">
                        <a href="Catalogo/catalogo.php?categoria=ninos"><p>Niño/a</p></a> 
                    </div>
                </div>
            </div>

            <div class="container3">
                <div class="info2">
                    <h1>Rebajas %</h1><br>
                    <p>
                        No te pierdas las rebajas <br>
                        de hasta 50% de descuento.
                    </p>
                    <button><a href="Catalogo/catalogo.php?rebajas=true">Ver mas</a></button>
                </div>    
            </div>
		</div>	
	</main>
	<footer>
		<p>&copy; 2020 | Drackode | Aguascalientes, Mexico</p>      	
	</footer>
</body>
</html>