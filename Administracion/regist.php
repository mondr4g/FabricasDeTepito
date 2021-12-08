<?php
    include '../DB_FUNCTIONS/DB_Functions.php';
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../CSS/log.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../CSS/resp.css?v=<?php echo time(); ?>">
</head>
<body>
    <?PHP
        if (!$_POST) {
    ?>
    <header>
        <nav>
            <h1 class="logo">LiverPuri</h1>
        </nav>
    </header>
	<main>
		<div class="home-grid">
            <div class="regist">
                <div class="form-regist">
                    <form method="POST" action="">
                        <h1> Registro </h1>
                        <div class="input-group">
                            <label> Usuario </label>
                            <input type="text" name="txtusr" autocomplete="off" required >
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Contraseña </label>
                                <input type="text" name="txtpasswd" autocomplete="off" required>
                            </div>
                            <div class="input-group">
                                <label> Confirmar Contraseña </label>
                                <input type="password" name="txtpasswd1" autocomplete="off">
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Primer Nombre </label>
                                <input type="text" name="nom1" autocomplete="off" required>
                            </div>
                            <div class="input-group">
                                <label> Segundo Nombre </label>
                                <input type="text" name="nom2" autocomplete="off" >
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Apellido Paterno </label>
                                <input type="text" name="ape1" autocomplete="off" required>
                            </div>
                            <div class="input-group">
                                <label> Apellido Materno </label>
                                <input type="text" name="ape2" autocomplete="off" >
                            </div>    
                        </div>
                        <div class="input-group">
                            <label> Fecha de Nacimiento </label>
                            <input type="date" name="fecha" required>
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Email </label>
                                <input type="email" name="email" autocomplete="off" required>
                            </div>
                            <div class="input-group">
                                <label> Telefono </label>
                                <input type="tel" name="tel" autocomplete="off" required>
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label>Estado</label>
                                <select name="estado" required>
                                    <option value="no">Seleccione uno...</option>
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
                                <input type="text" name="ciudad" autocomplete="off" required>
                            </div>   
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Colonia </label>
                                <input type="text" name="colonia" autocomplete="off" required>
                            </div>
                            <div class="input-group">
                                <label> Calle </label>
                                <input type="text" name="calle" autocomplete="off" required>
                            </div>    
                        </div>
                        <div class="input2">
                            <div class="input-group">
                                <label> Num Ext. </label>
                                <input type="text" name="num_e" autocomplete="off" required>
                            </div>
                            <div class="input-group">
                                <label> Num Int. </label>
                                <input type="text" name="num_i" autocomplete="off" >
                            </div> 
                            <div class="input-group">
                                <label> Codigo Postal </label>
                                <input type="text" name="c_p" autocomplete="off" required>
                            </div>      
                        </div>
                        <?php
                        //esta parate es donde se evalua que tipo de usuario se ingresara, se envian datos diferentes
                        //de acuerdo a quien este loggeado
                            if (isset($_SESSION['admin_on'])) {
                                ?>
                                <div class="input2">
                                    <div class="input-group">
                                        <label>Tipo</label>
                                        <select name="tipo">
                                            <option value="no" >Seleccionar tipo</option>
                                            <option value="1" >Cliente</option>
                                            <option value="2" >Administrador</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label> ROL </label>
                                        <input type="text" name="rol" autocomplete="off" required>
                                    </div> 
                                </div>
                                <input type="hidden" name="tipo" value="1">
                                <div class="input2">
                                    <div style="width: 100%; justify-content: left;">
                                        <label>Genero</label>
                                        <div style="display: flex; width: 30%">
                                            <input type="radio" name="genero" value="hombre"> Hombre
                                        </div>
                                        <div style="display: flex; width: 25%">
                                            <input type="radio" name="genero" value="mujer"> Mujer
                                        </div>
                                    </div>
                                    <div class="input-group" >
                                        <label >Gustos</label>
                                        <input type="text" name="gustos" id="gustos">
                                    </div>
                                </div>
                        <?php
                            }else{
                                //esta parte se puede mejorar, para mostrar o elegir las categorias tanto de genero como para los gustos
                        ?>
                                <input type="hidden" name="tipo" value="1">
                                <div class="input2">
                                    <div style="width: 100%; justify-content: left;">
                                        <label>Genero</label>
                                        <div style="display: flex; width: 30%">
                                            <input type="radio" name="genero" value="hombre"> Hombre
                                        </div>
                                        <div style="display: flex; width: 25%">
                                            <input type="radio" name="genero" value="mujer"> Mujer
                                        </div>
                                    </div>
                                    <div class="input-group" >
                                        <label >Gustos</label>
                                        <input type="text" name="gustos" id="gustos">
                                    </div>
                                </div>
                        <?php
                            }
                        ?>
                        <button type="submit" name="iniciar" class="sign-in" id="new-user"> Registrar </button>
                    </form>
                </div>
            </div>
		</div>	
    </main>
    <footer>
        <p>&copy; 2020 | Drackode | Aguascalientes, Mexico</p>      	    
    </footer>
    <?php
            //abierto a modificacion si solo queremos que el admin registre usuarios
        }elseif ($_POST  && ( isset($_SESSION['admin_on']) || isset($_SESSION['client_on']))) {
            $new_user_data = array(
                "username" => $_POST['txtusr'],
                "password" => $_POST['txtpasswd'],
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

            //evaluamos si se inserto de manera correcta o no
            if(insert_user($new_user_data)){
                //aqui para meter scripts de JS o mensajes
                //abierto a sugerencias
                $id=select_user_id($new_user_data['username']);
                if($_POST['tipo']=="1"){
                    insert_client($id,$_POST['genero'],$_POST['gustos']);
                }elseif($_POST['tipo']=="2"){
                    insert_admin($id,$_POST['rol']);
                }
                if($_SESSION['admin_on'])
                    header('location:index_admin.php');
                else
                    header('location:../Sesiones/login.php');
            }else{
                //abierto a mejoras
                header("location:regist.php");
            }
        }
    ?>
</body>
</html>