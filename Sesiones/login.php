<?php
    session_start();
    include '../DB_FUNCTIONS/DB_Functions.php';
    include '../Carrito/ticket.php';
    //validar si aun no se ha realizado el login
    if(isset($_GET['valid']))
        $v = $_GET['valid'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
    <link rel="stylesheet" type="text/css" href="../CSS/log.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../CSS/resp.css?v=<?php echo time(); ?>">
    <script type="text/javascript" src="../JS/valid.js?v=<?php echo time(); ?>"></script>
</head>
<body>
    <?php
        if (!$_POST) {
    ?>
	<main>
		<div class="home-grid">
			<div class="main-img">
            </div>
            <div class="login">
                <h3>LIVERPURI.</h3>
                <div class="form-login">
                    <form method="POST" action="login.php">
                        <h1> Iniciar Sesión </h1>
                        <div class="input-group">
                            <label> Usuario </label>
                            <input type="text" id="user" name="user" autocomplete="off">
                        </div>
                        <div class="input-group">
                            <label> Contraseña </label>
                            <input type="password" id="passw" name="passw" autocomplete="off">
                        </div>  
                        <button type="submit" name="iniciar" class="sign-in"> Login </button>
                        <?php
                            if(isset($_GET['valid'])) {
                                if($v == "false") {
                                    echo "<p id='msgError'>Usuario o Contraseña Invalida</p><br>";
                                }
                            }
                        ?>
                        <a id="regist-btn" href="../Administracion/regist.php">Registrarse</a>
                    </form>
                </div>
                <div class="copy">
                    <p>&copy; 2020 | Drackode | Aguascalientes, Mexico</p>      	    
                </div>
            </div>
		</div>	
	</main>
    <?php
        }elseif($_POST && (!isset($_SESSION['admin_on']) && !isset($_SESSION['client_on']) )){
            $usuario=validate_user($_POST['user'],$_POST['passw']);
            $us=select_user($usuario['Id_usuario']);
            if($usuario){
                //aqui se decide que tipo de usuario es 
                if(select_admin($usuario['Id_usuario'])){
                    $_SESSION['admin_on']=$usuario['Id_usuario'];
                    header("location:../Administracion/index_admin.php");
                }else{
                    $_SESSION['client_on']=$usuario['Id_usuario'];
                    if(intval(date("d")) >= 1 && intval(date("d")) < 20) {
                        sendMailNew($us['email']);
                    }
                    header("location:../index.php");
                }
                //puta madreeee
            }else{
                $_SESSION['admin_on']=null;
                $_SESSION['client_on']=null;
                header("Location: login.php?valid=false");
            }


        }
?>
</body>
</html>
