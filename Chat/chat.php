<?php
  session_start();

  if(isset($_SESSION['admin_on'])){
    $_SESSION['chat']=$_GET['chat'];
  }
  if(isset($_SESSION['client_on'])){
    $_SESSION['chat']=$_SESSION['client_on'];
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chat</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../CSS/resp.css?v=<?php echo time(); ?>">
    <script type="text/javascript" src="../JS/catalog.js?v=<?php echo time(); ?>"></script>
    <script type="text/javascript" src="../JS/ajax.js"></script>
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
                <li><a href="../Catalogo/catalogo.php">Nuevos Lanzamientos</a></li>
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
        <div id="title-chat">
          <h2>Live Chat</h2>          
        </div>
        <div class="mensajes">
          <div id="cajachat"></div>
          <div name="timediv" id="timediv"></div>
        </div>
        <div class="msgChat">
          <form method="post" action="enviar.php">
              <input style="font-size: 15px;" type="text" class="caja" name="mensaje" size="50" placeholder=" Escribe un mensaje..." required>
              <button type='submit' class="boton-link2" value='Enviar'>Enviar</button>
          </form>
        </div>
      </div>
  </main>
  <footer>
		<p>&copy; 2020 | Drackode | Aguascalientes, Mexico</p>      	
  </footer>                  
</body>
</html>