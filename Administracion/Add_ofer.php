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
                        <h1> Agregar nueva oferta</h1>
                        <div class="input2">
                        <div class="input-group">
                                <label> Producto </label>
                                <select name="producto" required>
                                
                                <?php
                                $prods=select_all_products_without();
                                    foreach($prods as $pr){
                                        echo $pr['ID_producto'];
                                ?>
                                        <option value="<?php echo $pr['ID_producto']; ?>"><?php echo $pr['nombre']?></option>
                                <?php
                                    }
                                ?>
                                    
                                </select>                            
                            </div>    
                            <div class="input-group">
                                <label> Porcentaje </label>
                                <input type="text" name="porcen" autocomplete="off" value="" required>
                            </div>
                            
                        </div>
                        
                        <div class="input2">
                            <div class="input-group">
                                <label> Fecha de Inicio </label>
                                <input type="date" name="fec_ini" required>
                            </div>
                            <div class="input-group">
                                <label> Fecha de Fin </label>
                                <input type="date" name="fec_fin" required>
                            </div>
                        </div>
                        
                        <input type="hidden" name="tipo" value="p">
                        <button type="submit" name="btnAction" class="sign-in" id="new-user" value="Guardar"> Guardar </button>
                    </form>    

    <?php
        }elseif($_POST && !isset($_SESSION['client_on']) ){
       
            $prod_daaaa=array();
            $prod_daaaa+=["id_prod"=>$_POST['producto']];
            $prod_daaaa+=["porcentaje" => $_POST['porcen']];
            $prod_daaaa+=["fecha_ini" => $_POST['fec_ini']];
            $prod_daaaa+=["fecha_fin" => $_POST['fec_fin']];
        
            if(new_offer($prod_daaaa)){
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
    } else {
        header("Location: ../index.php");
    }
?>