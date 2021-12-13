<?php
    session_start();

    include '../DB_FUNCTIONS/DB_functions.php';

    if(isset($_SESSION['admin_on'])){

        if ($_POST) {
            //echo 'si llego post';
            if ($_POST['btnAction']) {//Aqui para realizar la actualizacion de los valores.
                //envia por post, la info o lo que sea, tambien un distintivo para saber, cuando se modifica un admin o un cliente normal.
                //todavia no acabo aqui xdxdxdxd
                
                switch ($_POST['tipoo']) {
                    case 'u':
                        //echo "llego usuario";
                    
                    
                        $password=null;
                        if ($_POST['txtpasswd']=="") {
                            $password=obtain_pass($_POST['id_us'])['PASS'];
                            //echo "No hay contra";
                        } elseif (obtain_pass($_POST['id_us'])['PASS']==sha1($_POST['txtpasswd'])) {
                            $password=obtain_pass($_POST['id_us'])['PASS'];
                            //echo "es la misma";
                        } else {
                            $password=sha1($_POST['txtpasswd']);
                            //echo "es nueva";
                        }
                        
                        $user_data=array(
                            "id"=>$_POST['id_us'],
                            "id_dir"=>$_POST['id_dir'],
                            "username" => $_POST['txtusr'],
                            "password" => $password,
                            "nom_1" => $_POST['nom1'],
                            "nom_2" => $_POST['nom2'],
                            "ape_1" => $_POST['ape1'],
                            "ape_2" => $_POST['ape2'],
                            "fec_nac" => $_POST['fecha'],
                            "email" => $_POST['email'],
                            "tel" => $_POST['tel'],
                            "estado" => $_POST['estado'],
                            "ciudad" => $_POST['ciudad'],
                            "colonia" => $_POST['colonia'],
                            "calle" => $_POST['calle'],
                            "num_ext" => $_POST['num_e'],
                            "num_int" => $_POST['num_i'],
                            "codigo" => $_POST['c_p']
                        );
                        $usuario=null;
                        if ($_POST['imp']=="a") {
                            //echo "llego admin";
                            $user_data+=['Id_admin' => $_POST['id_us']];
                            $user_data+=['rol' => $_POST['rol'] ];
                            if (modify_admin($user_data)) {
                                //si se logro
                                header('location:index_admin.php');
                            }
                        } elseif ($_POST['imp']=="c") {
                            echo "llego cliente";
                            $user_data+=['COD_CLIENTE' => $_POST['id_us']];
                            //$user_data+=['gustos' => $_POST['gustos']];
                            $user_data+=['SEXO' => $_POST['genero']];
                            //print_r($user_data);

                            if (modify_cliente($user_data)) {
                                //si se logro
                                header('location:index_admin.php');
                            }
                        }

                    break;
                
                    case 'p':
                        # code...
                        $tallas='{"XS":'.$_POST['XS'].',"S":'.$_POST['S'].',"M":'.$_POST['M'].',"L":'.$_POST['L'].',"XL":'.$_POST['XL'].'}';
                        $ims='{"I1":"'.$_POST['img1'].'", "I2":"'.$_POST['img2'].'","I3":"'.$_POST['img3'].'"}';
                        $prod_daaaa=array();
                        $prod_daaaa+=["id"=>$_POST['id_prod']];
                        $prod_daaaa+=["nombre" => $_POST['nombre']];
                        $prod_daaaa+=["detalles" => $_POST['detalles']];
                        $prod_daaaa+=["precio" => $_POST['precio']];
                        $prod_daaaa+=["marca" => $_POST['marca']];
                        $prod_daaaa+=["tipo" => $_POST['tipo33']];
                        $prod_daaaa+=["tallas" => $tallas];
                        $prod_daaaa+=["categoria" => $_POST['categoria']];
                        $prod_daaaa+=["fecha" => $_POST['fecha_lan']];
                        $prod_daaaa+=["imgs" => $ims];
                        $prod_daaaa+=["status"=> $_POST['status']];
                        
                        if (update_producto($prod_daaaa)) {
                            //muestra confirmacion de que si se logro el update
                            header('location:index_admin.php');
                        } else {
                            //No se logro
                        }

                        break;
                }
            }
        }
?>
    <!-- AQUI METELE LO PRIMERO DEL DISEÑO -->

    <!-- AQUI METE LO DEL HEADER-->

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
                    <li><a href="Estadisticas.php">Estadisticas</a></li>
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
            <div class="regist">
                <div class="form-regist">    
<?php

        if($_GET){
            switch($_GET['tipo']){
                case'u'://Aqui es cuando llega un usuario
                    $usuario=null;
                    if($_GET['imp']=="a"){
                        $usuario=get_admin($_GET['id_us']);
                        $us_type = "admin";
                    }elseif($_GET['imp']=="c"){
                        $usuario=get_client($_GET['id_us']);
                        $us_type = "client";
                    }

                    //$usuario contiene toda la info del usuario ya sea admin o cliente, puedes utilizar
                    //estas comparaciones para separar los campos que tenga cada uno.
?>
    <!-- AQUI LE METES LO DELUSUARIO. -->
                    <form method="POST" action="">
                        <h1> Editar Usuario </h1>
                        <div class="input-group">
                            <label> Usuario </label>
                            <input type="text" name="txtusr" autocomplete="off" value="<?php echo $usuario['USERNAME'] ?>" required >
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Contraseña </label>
                                <input type="text" name="txtpasswd" autocomplete="off" value="">
                            </div>
                            <div class="input-group">
                                <label> Confirmar Contraseña </label>
                                <input type="password" name="txtpasswd1" value="" autocomplete="off">
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Primer Nombre </label>
                                <input type="text" name="nom1" value="<?php echo $usuario['P_NOMBRE'] ?>" autocomplete="off" required>
                            </div>
                            <div class="input-group">
                                <label> Segundo Nombre </label>
                                <input type="text" name="nom2" value="<?php echo $usuario['S_NOMBRE'] ?>" autocomplete="off" >
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Apellido Paterno </label>
                                <input type="text" name="ape1" value="<?php echo $usuario['APE_PAT'] ?>" autocomplete="off" required>
                            </div>
                            <div class="input-group">
                                <label> Apellido Materno </label>
                                <input type="text" name="ape2" value="<?php echo $usuario['APE_MAT'] ?>" autocomplete="off" >
                            </div>    
                        </div>
                        <div class="input-group">
                            <label> Fecha de Nacimiento </label>
                            <input type="date" name="fecha" value="<?php echo $usuario['FEC_NAC'] ?>" required>
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Email </label>
                                <input type="email" name="email" autocomplete="off" value="<?php echo $usuario['EMAIL'] ?>" required>
                            </div>
                            <div class="input-group">
                                <label> Telefono </label>
                                <input type="tel" name="tel" autocomplete="off" value="<?php echo $usuario['TELEFONO'] ?>" required>
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label>Estado</label>
                                <select name="estado" required>
                                    <option value="<?php echo $usuario['ESTADO'] ?>" selected><?php echo $usuario['ESTADO'] ?></option>
                                    <option value="Aguascalientes">Aguascalientes</option>
                                    <option value="Baja California">Baja California</option>
                                    <option value="Baja California Sur">Baja California Sur</option>
                                    <option value="Campeche">Campeche</option>
                                    <option value="Chiapas">Chiapas</option>
                                    <option value="Chihuahua">Chihuahua</option>
                                    <option value="CDMX">Ciudad de México</option>
                                    <option value="Coahuila">Coahuila</option>
                                    <option value="Colima">Colima</option>
                                    <option value="Durango">Durango</option>
                                    <option value="Estado de México">Estado de México</option>
                                    <option value="Guanajuato">Guanajuato</option>
                                    <option value="Guerrero">Guerrero</option>
                                    <option value="Hidalgo">Hidalgo</option>
                                    <option value="Jalisco">Jalisco</option>
                                    <option value="Michoacán">Michoacán</option>
                                    <option value="Morelos">Morelos</option>
                                    <option value="Nayarit">Nayarit</option>
                                    <option value="Nuevo León">Nuevo León</option>
                                    <option value="Oaxaca">Oaxaca</option>
                                    <option value="Puebla">Puebla</option>
                                    <option value="Querétaro">Querétaro</option>
                                    <option value="Quintana Roo">Quintana Roo</option>
                                    <option value="San Luis Potosí">San Luis Potosí</option>
                                    <option value="Sinaloa">Sinaloa</option>
                                    <option value="Sonora">Sonora</option>
                                    <option value="Tabasco">Tabasco</option>
                                    <option value="Tamaulipas">Tamaulipas</option>
                                    <option value="Tlaxcala">Tlaxcala</option>
                                    <option value="Veracruz">Veracruz</option>
                                    <option value="Yucatán">Yucatán</option>
                                    <option value="Zacatecas">Zacatecas</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label> Ciudad </label>
                                <input type="text" name="ciudad" autocomplete="off" value="<?php echo $usuario['CIUDAD'] ?>" required>
                            </div>   
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Colonia </label>
                                <input type="text" name="colonia" autocomplete="off" value="<?php echo $usuario['COLONIA'] ?>" required>
                            </div>
                            <div class="input-group">
                                <label> Calle </label>
                                <input type="text" name="calle" autocomplete="off" value="<?php echo $usuario['CALLE'] ?>" required>
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Num Ext. </label>
                                <input type="text" name="num_e" autocomplete="off" value="<?php echo $usuario['NUMERO'] ?>" required>
                            </div>
                            <div class="input-group">
                                <label> Num Int. </label>
                                <input type="text" name="num_i" autocomplete="off" value="<?php echo $usuario['NUM_INTERIOR'] ?>">
                            </div> 
                            <div class="input-group">
                                <label> Codigo Postal </label>
                                <input type="text" name="c_p" autocomplete="off" value="<?php echo $usuario['COD_POSTAL'] ?>" required>
                            </div>      
                        </div>
                        <?php
                        //esta parate es donde se evalua que tipo de usuario se ingresara, se envian datos diferentes
                        //de acuerdo a quien este loggeado
                            if ($us_type == "client") {
                                ?>
                                
                                <div class="input2">
                                    <div style="width: 100%; justify-content: left;">
                                        <label>Genero</label>
                                        <?php
                                            if ($usuario['SEXO'] == "M") {
                                        ?>
                                            <div style="display: flex; width: 30%">
                                                <input type="radio" name="genero" value="hombre"> Hombre
                                            </div>
                                            <div style="display: flex; width: 25%">
                                                <input type="radio" name="genero" value="mujer" checked> Mujer
                                            </div>
                                        <?php
                                            }else {
                                                ?>
                                            <div style="display: flex; width: 30%">
                                                <input type="radio" name="genero" value="hombre" checked> Hombre
                                            </div>
                                            <div style="display: flex; width: 25%">
                                                <input type="radio" name="genero" value="mujer"> Mujer
                                            </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                        <?php
                            }else{
                                ?>
                                <div class="input-group" >
                                        <label >ROL</label>
                                        <input type="text" name="rol" id="rol" value="<?php echo $usuario['ROL'] ?>">
                                    </div>
                                    
                        <?php
                            }
                        ?>
                        <input type="hidden" name="tipoo" value="u">
                        <input type="hidden" name="imp" value="<?php echo $_GET['imp']?>">
                        <input type="hidden" name="id_us" value="<?php echo $usuario['ID_PERSONA']?>">
                        <input type="hidden" name="id_dir" value="<?php echo $usuario['ID_DIRECCION']?>">
                        <button type="submit" name="btnAction" class="sign-in" id="new-user" value="Guardar"> Guardar </button>
                    </form>
    <!-- FORM DE USUARIO/ADMIN-->
<?php

                    break;
                
                case 'p':
                    //Aqui traere el producto y las .
                    $info_prod=especific_product($_GET['id_prod']);//ya viene como un array asociado
                    $tallas=$info_prod['TALLA'];
                    $imgs=$info_prod['RUTA'];

?>
    <!-- Aqui le metes lo del formulario para el producto. --->
    <form method="POST" action="">
                        <h1> Editar Producto </h1>
                        <div class="input-group">
                            <label> Nombre </label>
                            <input type="text" name="nombre" autocomplete="off" value="<?php echo $info_prod['NOMBRE'] ?>" required >
                        </div>
                        <div class="input-group">
                            <label> Detalles </label>
                            <input type="text" name="detalles" autocomplete="off" value="<?php echo $info_prod['DESCRIPCION'] ?>" required >
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Marca </label>
                                <input type="text" name="marca" autocomplete="off" value="<?php echo $info_prod['MARCA'] ?>" required>
                            </div>
                            <div class="input-group">
                                <label> Tipo </label>
                                <select name="tipo33" required>
                                    <option value="<?php echo $info_prod['tipo'] ?>"><?php echo $info_prod['CATEGORIA'] ?></option>
                                    <option value="playera">Playeras</option>
                                    <option value="pantalon">Pantalones</option>
                                    <option value="chamarra">Chamarras</option>
                                    <option value="sudadera">Sudaderas</option>
                                    <option value="abrigo">Abrigos</option>
                                    <option value="hombre">Hombre</option>
                                    <option value="mujer">Mujer</option>
                                    <option value="ninos">Kids</option>
                                </select>                            
                            </div>    
                        </div>
                        <div class="input-group">
                            <label> Fecha de Lanzamiento </label>
                            <input type="date" name="fecha_lan" value="<?php echo $info_prod['FECHA_LANZAMIENTO'] ?>" required>
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Precio </label>
                                <input type="text" name="precio" autocomplete="off" value="<?php echo $info_prod['PRECIO'] ?>" required>
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Talla XS </label>
                                <input type="text" name="stockXS" autocomplete="off" value="<?php echo $tallas->XS?>" required>
                            </div>
                            <div class="input-group">
                                <label> Talla S </label>
                                <input type="text" name="stockS" autocomplete="off" value="<?php echo $tallas->S?>" required>
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Talla M </label>
                                <input type="text" name="stockM" autocomplete="off" value="<?php echo $tallas->M?>" required>
                            </div>
                            <div class="input-group">
                                <label> Talla L </label>
                                <input type="text" name="stockL" autocomplete="off" value="<?php echo $tallas->L?>" required>
                            </div>    
                        </div>
                        <div class="input-group">
                            <label> Talla XL </label>
                            <input type="text" name="stockXL" value="<?php echo $tallas->XL?>" required>
                        </div>
                            <div class="input-group">
                                <label> URL IMG-1 </label>
                                <input type="text" name="img1" autocomplete="off" value="<?php echo $imgs?>"  required>
                            </div>
                        <div class="input-group">
                            <label> Estatus </label>
                            <input type="text" name="status" value="<?php echo $info_prod['STATUS'] ?>" required>
                        </div>
                        <input type="hidden" name="tipoo" value="p">
                        <input type="hidden" name="id_prod" value="<?php echo $info_prod['ID_PRODUCTO']?>">
                        <button type="submit" name="btnAction" class="sign-in" id="new-user" value="Guardar"> Guardar </button>
                    </form>    
<?php                    
                    break;

            }
        }
    }else {
        header("Location: ../index.php");
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