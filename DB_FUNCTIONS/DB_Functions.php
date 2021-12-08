<?php
    include 'DB_connection.php';
    //asignacion de la conexion a mysql como una variable global para que sea accesible dentro de este archivo.
    $GLOBALS['conne']=$conne;

    //*********************** 
    //Funciones para el login
    //***********************
    //SELECT * FROM `producto` NATURAL JOIN `descripcion_producto` WHERE descripcion_producto.talla='xs'
    //funcion para obtener el usuario
    function validate_user($username,$password){
        $usuario=null;
        $sql_select = "SELECT * FROM usuario WHERE username = '$username';";
        $result = $GLOBALS['conne']->query($sql_select);
        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            if (sha1($password)!=$usuario['passw']) {
                return null;
            }
            /*if ($password!=$usuario['passw']) {
                return null;
            }*/
            return $usuario;
        }else{
            return $usuario;
        }
    }

    function select_user_id($username){
        $usuario=null;
        $sql_select = "SELECT * FROM usuario WHERE username = '$username';";
        $result = $GLOBALS['conne']->query($sql_select);
        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            return $usuario['Id_usuario'];
        }else{
            return $usuario;
        }
    }
    //funcion para identificar el usuario como cliente
    function select_client($id_usuario){
        $sql_select_client= "SELECT * FROM cliente WHERE Id_cliente = '$id_usuario';";
        $cli=$GLOBALS['conne']->query($sql_select_client);
        if($cli->num_rows>0){
            return true ;
        }else{
            echo $cli->mysqli_error();
            return false;
        }
    }
    //funcion para identificar al usuario como admin
    function select_admin($id_usuario){
        $sql_select_admin= "SELECT * FROM administrador WHERE Id_admin = '$id_usuario' ;";
        $ad=$GLOBALS['conne']->query($sql_select_admin);
        if($ad->num_rows>0){
            return true;
        }else{
            return false;
        }
    }

    //funcion que retorna un usuario
    function select_user($id_usuario){
        $sql_select_admin= "SELECT * FROM usuario WHERE Id_usuario = '$id_usuario' ;";
        $ad=$GLOBALS['conne']->query($sql_select_admin);
        if($ad->num_rows>0){
            return $ad->fetch_assoc();
        }else{
            return null;
        }
    }

    //funcion para recuperar admin de ventas
    function select_sales_admin(){
        $sql_sel="SELECT * FROM usuario INNER JOIN administrador ON usuario.Id_usuario=administrador.Id_admin WHERE administrador.rol='ventas'";
        $r=$GLOBALS['conne']->query($sql_sel);
        if($r->num_rows>0){
            return $r->fetch_assoc();
        }else{
            return null;
        }
    }

    //***********************
    //Funciones para insertar nuevos usuarios
    //***********************
    //insertar usuarios en general
    function insert_user($user_data){
        //$user_data['fecha']
        if (!search_user_by_usname($user_data['username'])) {
            $nueva_fecha="";
            $sql_insert="INSERT INTO `usuario`( `username`, `passw`, `email`, `p_nombre`, `s_nombre`, `ape_pat`, `ape_mat`,`fec_nac`, `telefono`) VALUES ".
            "('".$user_data['username']."','".sha1($user_data['password'])."','".$user_data['email']."',".
            "'".$user_data['nom_1']."','".$user_data['nom_2']."','".$user_data['ape_1']."','".$user_data['ape_2']."',".
            "'".$user_data['fec_nac']."','".$user_data['tel']."');";

            //, `ciudad`, `colonia`, `estado`, `calle`, `numero`, `num_interior`, `cod_postal`
            //'".$user_data['ciudad']."','".$user_data['colonia']."',".
            //"'".$user_data['estado']."','".$user_data['calle']."',".intval($user_data['num_ext']).",'".$user_data['num_int']."','".$user_data['codigo']."'
            if ($GLOBALS['conne']->query($sql_insert)) {
                echo "<script>alert('AAAAA')</script>";
                $sql_rec="SELECT * FROM usuario ORDER by Id_usuario DESC LIMIT 1";
                $res=$GLOBALS['conne']->query($sql_rec);
                if($res->num_rows>0){
                    $p=$res->fetch_assoc();
                    $sql_ins_dir="INSERT INTO `direcciones`(`Id_usuario`,`estado`, `ciudad`, `colonia`, `cod_postal`, `calle`, `numero`, `num_interior` ) VALUES ".
                    "(".intval($p['Id_usuario']).",'".$user_data['estado']."','".$user_data['ciudad']."','".$user_data['colonia']."','".$user_data['calle']."','".$user_data['codigo']."',".intval($user_data['num_ext']).",'".$user_data['num_int']."');";
                   
                    if($GLOBALS['conne']->query($sql_ins_dir)){
                        return true;
                    }else{
                        return false;
                    }
                    return true;
                }else{
                    return false;
                }
                return true;
            } else {
                echo "la";
                return false;
            }
        }else{
            return false;
        }
    }
    //inertar administrador
    function insert_admin($id_user){
        $sql_insert="INSERT INTO `administrador`(`Id_admin`,`rol`) VALUES ".
        "(".intval($id_user).");";
        $GLOBALS['conne']->query($sql_insert);
    }
    //insertar clientes
    function insert_client($id_user,$genero,$gustos){
        $sql_insert="INSERT INTO `cliente`(`Id_cliente`, `gustos`,`genero`) VALUES ".
        "(".intval($id_user).",'$gustos','$genero');";
        $GLOBALS['conne']->query($sql_insert);
    }


    //RECUPERAR TODOS LOS CLIENTES
    function select_all_clients(){
        $sql_select_client="SELECT * FROM usuario INNER JOIN cliente ON usuario.Id_usuario=cliente.Id_cliente;";
        $result=$GLOBALS['conne']->query($sql_select_client);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }
    }

    //busqueda de cliente por username
    function search_client_by_name($username){
        $sql_bus="SELECT * FROM usuario NATURAL JOIN cliente WHERE usuario.username LIKE '%$username%';";
        $result=$GLOBALS['conne']->query($sql_bus);
        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return null;
        }
    }

    //busqueda de admin por username
    function search_admin_by_name($username){
        $sql_bus="SELECT * FROM usuario NATURAL JOIN administrador WHERE usuario.username LIKE '%$username%';";
        $result=$GLOBALS['conne']->query($sql_bus);
        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return null;
        }
    }

    //buscar usuario por username
    function search_user_by_usname($usname){
        $sql_select="SELECT * FROM usuario WHERE ".
        "usuario.username='".$usname."';";
        if($result->num_rows>0){
            return true;
        }else{
            return false;
        }
    }

    //recuperar todos los administradores
    function select_all_admins(){
        $sql_select_client="SELECT * FROM usuario INNER JOIN administrador ON usuario.Id_usuario=administrador.Id_admin;";
        $result=$GLOBALS['conne']->query($sql_select_client);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }
    }

    //recuperar un admin especifico
    function get_admin($id_admin){
        $sql_sel="SELECT * FROM usuario NATURAL JOIN administrador WHERE usuario.Id_usuario=".intval($id_admin).";";
        $result=$GLOBALS['conne']->query($sql_sel);
        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return null;
        }
    }

    //recuperar un cliente especific
    function get_client($id_client){
        $sql_sel="SELECT * FROM usuario NATURAL JOIN cliente WHERE usuario.Id_usuario=".intval($id_client).";";
        $result=$GLOBALS['conne']->query($sql_sel);
        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return null;
        }
    }

    //funcion para eliminar cualquier usuario, se supone que la base de datos realiza una eliminacion e actualizacion en cascada
    function delete_user($id_usuario){
        $sql_del="DELETE FROM usuario WHERE usuario.Id_usuario=".intval($id_usuario).";";
        if($GLOBALS['conne']->query($sql_del)){
            return true;
        }else{
            return false;
        }
    }

    //***********************
    //Funciones para los productos
    //***********************
    //retorna todos los productos de la base de datos
    function select_all_products(){
        $sql_select = "SELECT * FROM producto WHERE producto.status=1;";
        $result = $GLOBALS['conne']->query($sql_select);
        if ($result->num_rows>0) {
            return $result;
        }else{
            return null;
        }
    }
    //Retorna un producto de acuerdo al ID que se recibe como parametro.
    function especific_product($id_product){
        $producto=null;
        $sql_select="SELECT * FROM producto WHERE ID_producto = ".intval($id_product).";";
        $result=$GLOBALS['conne']->query($sql_select);
        if($result->num_rows>0){
            $producto=$result->fetch_assoc();
            return $producto;
        }else{
            return $producto;
        }
    }
    //insertar producto
    function insert_product($p_data){
        //Asumimos que los datos del nuevo producto vienen definidos en un vector.
        //se supone que la estructura de las imagenes ya viene definida como string JSON.
        //se supone que las tallas vienen definidas en un string JSON
        //,".doubleval($p_data['precio']).",".intval($p_data['stock']).",
        $sql_insert="INSERT INTO `producto`(`nombre`, `detalles`,`precio`, `marca`, `tipo`, `tallas`,".
        "`Fecha_lanzamiento`, `categoria`, `imgs`, `status`) VALUES ".
        "('".$p_data['nombre']."','".$p_data['detalles']."',".doubleval($p_data['precio']).",'".$p_data['marca']."',".
        "'".$p_data['tipo']."','".$p_data['tallas']."','".$p_data['fecha']."','".$p_data['categoria']."','".$p_data['imgs']."',".intval($p_data['status']).");";

        if($GLOBALS['conne']->query($sql_insert)){
            return true;
        }else{
            return false;
        }
    }

    //Actualizar producto
    function update_producto($prod_data){
        //se actualiza todo excepto la fecha de lanzamiento
        $sql_updt="UPDATE producto SET ".
        "nombre ='".$prod_data['nombre']."',".
        "detalles='".$prod_data['detalles']."',precio=".doubleval($prod_data['precio']).",marca='".$prod_data['marca']."'".
        ",tipo='".$prod_data['tipo']."',tallas='".$prod_data['tallas']."',categoria='".$prod_data['categoria']."'".
        ",imgs='".$prod_data['imgs']."',status=".intval($prod_data['status'])." WHERE ID_producto=".intval($prod_data['id']).";";
        if($GLOBALS['conne']->query($sql_updt)){
            return true;
        }else{
            return false;
        }
    }



    //funcion para el prodcuto mas caro
    function producto_mas(){
        $sql_prod="SELECT * FROM producto WHERE producto.precio = MAX(producto.precio);";
        $result=$GLOBALS['conne']->query($sql_prod);
        if ($result->num_rows>0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function producto_menos(){
        //funcion para el prodcuto mas barato
        $sql_prod="SELECT * FROM producto WHERE producto.precio = MIN(producto.precio);";
        $result=$GLOBALS['conne']->query($sql_prod);
        if ($result->num_rows>0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }    
    //funcion para seleccionar productos de acuerdo a los filtros
    function products_by_price($min, $max){
        $sql_prod="SELECT * FROM producto WHERE producto.precio BETWEEN $min AND $max;";
        $result=$GLOBALS['conne']->query($sql_prod);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }
    }

    //obtener productos por categoria

    function products_by_cat($cat){
        $sql_select="SELECT * FROM producto WHERE producto.categoria LIKE '%$cat%';";
        $result=$GLOBALS['conne']->query($sql_select);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }
    }

    //obtener rebajas
    function get_rebajas(){
        $sql_ofertas="SELECT * FROM ofertas WHERE fec_inicio <= NOW() AND fec_fin >= NOW();";
        $result=$GLOBALS['conne']->query($sql_ofertas);
        if($result->num_rows>0){
            $rebajas=array();
            foreach($result as $reb){
                array_push($rebajas,especific_product($reb['Id_producto']));
            }
            return $rebajas;   
        }else{
            return null;
        }
    }

    //obtener nuevos lanzamientos
    function get_newProds(){
        $sql_news="SELECT * FROM producto WHERE MONTH(fecha_lanzamiento) = MONTH(CURDATE());";
        $result=$GLOBALS['conne']->query($sql_news);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }
    }



    //funcion para retornar el stock dependiendo de la talla que reciba
    function product_stock($id_prod, $talla){

        $sql_prod_stock="SELECT JSON_EXTRACT(tallas,'$.$talla') as STOCK FROM producto WHERE producto.ID_producto = ".intval($id_prod)." ;";
        $result=$GLOBALS['conne']->query($sql_prod_stock);
        if($result){
            return $result->fetch_assoc();
        }else{
            return null;
        }
    }

    //obtener los productos relacionados con los gustos del cliente
    function prods_relacionados($id_cliente){
        //Aqui recuperamos el cliente
        $sql_cat="SELECT cliente.genero FROM cliente WHERE Id_cliente=".intval($id_cliente).";";
        $res=$GLOBALS['conne']->query($sql_cat);
        $cat=$res->fetch_assoc();
        $oc=$cat['genero'];
        //Aca recuperamos los productos
        $sql_sel="SELECT * FROM producto WHERE producto.status=1 AND producto.categoria='$oc' LIMIT 4;";//Aqui podria agregar mas campos, si espedificamos de mejor manera.
        $result=$GLOBALS['conne']->query($sql_sel);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }

    }
    
    //********************** 
    //Para las compras
    //***********************
    function new_sale($cliente, $total){
        $sql_insert="INSERT INTO `compra`(`Id_cliente`, `total`) VALUES (".intval($cliente).",".doubleval($total).");";
        if ($GLOBALS['conne']->query($sql_insert)) {
            $sql_rec="SELECT * FROM compra ORDER by compra.Id_compra ASC LIMIT 1";
            $res=$GLOBALS['conne']->query($sql_rec);
            if($res->num_rows>0){
                $p=$res->fetch_assoc();
                return $p['Id_compra'];
            }else{
                return true;
            }
            
        }else{
            return false;
        }
    }

    //actualizar stock
    function actualiza_stock($id_prod, $talla, $cantidad){
        $stock=product_stock($id_prod, $talla);
        $st=intval($stock['STOCK'])-intval($cantidad);
        $sql_updt="UPDATE producto SET tallas=JSON_REPLACE(tallas,'$.$talla',$st) WHERE ID_producto=".intval($id_prod).";";
        $res=$GLOBALS['conne']->query($sql_updt);
        if($res){
            return true;
        }else{
            echo "error";
            return false;
        }
    }

    //eliminar un producto.
    function delete_product($id_prod){
        $sql_del="DELETE FROM producto WHERE producto.ID_producto=".intval($id_prod).";";
        if($GLOBALS['conne']->query($sql_del)){
            return true;
        }else{
            return false;
        }
    }

    //insertar detalle de compra
    function new_sale_detail($id_compra, $id_prod, $cant, $talla){
        //$prods es un array que contiene el id del producto, la talla y la cantidad.
        $sql_insert="INSERT INTO `detalle_compra` (`Id_compra`, `Id_producto`, `cantidad`, `talla`) VALUES (".intval($id_compra).",".intval($id_prod).",".intval($cant).",'".$talla."'); ";
        if($GLOBALS['conne']->query($sql_insert)){
            return true;
        }else{
            return false;
        }
    }

    //retornar los productos comprados detalle de compra
    function sale_details($id_compra){
        $sql_sel="SELECT * FROM detalle_compra INNER JOIN producto ON detalle_compra.Id_producto=producto.ID_producto WHERE Id_compra = ".intval($id_compra)." GROUP BY detalle_compra.Id_producto;";
        $result=$GLOBALS['conne']->query($sql_sel);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }

    }

    function get_sale($id_compra){
        $sql_sel="SELECT * FROM compra WHERE Id_compra=".intval($id_compra).";";
        $result=$GLOBALS['conne']->query($sql_sel);
        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return null;
        }
    }

    function obtain_pass($id_user){
        $sql_obta="SELECT passw FROM usuario WHERE Id_usuario=".intval($id_user).";";
        $result=$GLOBALS['conne']->query($sql_sel);
        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return null;
        }
    }

    //UPDATE `usuario` as u NATURAL JOIN cliente as c SET `num_interior`='A6', c.genero='Hombre' WHERE Id_usuario=1
    //faltan
    function modify_cliente($a_data){
        //UPDATE usuario AS u INNER JOIN cliente AS c ON u.Id_usuario=c.Id_cliente INNER JOIN direcciones AS d ON u.Id_usuario=d.Id_usuario SET d.estado='Aguas', c.gustos='caca', u.telefono='000000000'
        
        $sql_update="UPDATE usuario AS u INNER JOIN cliente AS c ON u.Id_usuario=c.Id_cliente INNER JOIN direcciones AS d ON u.Id_usuario=d.Id_usuario SET u.username=".
        "'".$a_data['username']."', u.passw='".$a_data['password']."' u.email='".$a_data['email']."',".
        "u.p_nombre='".$a_data['nom_1']."',u.s_nombre='".$a_data['nom_2']."',u.ape_pat='".$a_data['ape_1']."',u.ape_mat='".$a_data['ape_2']."',".
        "u.fec_nac='".$a_data['fec_nac']."',u.telefono='".$a_data['tel']."',d.ciudad='".$a_data['ciudad']."',d.colonia='".$a_data['colonia']."',".
        "d.estado='".$a_data['estado']."',d.calle='".$a_data['calle']."',d.numero='".$a_data['num_ext']."',d.num_interior='".$a_data['num_int']."',d.cod_postal='".$a_data['codigo']."', ".
        "c.gustos='".$a_data['gustos']."', c.genero='".$a_data['genero']."' WHERE u.Id_usuario=".intval($a_data['id'])." ;";
        if($GLOBALS['conne']->query($sql_update)){
            return true;
        }else{
            return false;
        }

    }

    function modify_admin($a_data){
        $sql_update="UPDATE usuario AS u INNER JOIN administrador AS a ON u.Id_usuario=a.Id_admin INNER JOIN direcciones AS d ON u.Id_usuario=d.Id_usuario SET u.username=".
        "'".$a_data['username']."', u.email='".$a_data['email']."',".
        "u.p_nombre='".$a_data['nom_1']."',u.s_nombre='".$a_data['nom_2']."',u.ape_pat='".$a_data['ape_1']."',u.ape_mat='".$a_data['ape_2']."',".
        "u.fec_nac='".$a_data['fec_nac']."',u.telefono='".$a_data['tel']."',d.ciudad='".$a_data['ciudad']."',d.colonia='".$a_data['colonia']."',".
        "d.estado='".$a_data['estado']."',d.calle='".$a_data['calle']."',d.numero='".$a_data['num_ext'].",d.num_interior='".$a_data['num_int']."',d.cod_postal='".$a_data['codigo']."' ".
        " WHERE u.Id_usuario=".intval($a_data['id'])." ;";
        if($GLOBALS['conne']->query($sql_update)){
            return true;
        }else{
            return false;
        }

    }


    //***********************
    //Funciones para los comentarios
    //***********************
    //insertar nuevo comentario
    function new_coment($coment_data){
        /*
            Estructura del array $coment_data:
                cliente: Id_cliente
                producto: Id_prodcuto
                comentario: comentario
        */
        $sql_insert="INSERT INTO `comentarios`(`Id_cliente`,`Id_producto`,`comentario`) VALUES ".
        "(".intval($coment_data['cliente']).",".intval($coment_data['producto']).",'".$coment_data['comentario']."' ) ;";
        if($GLOBALS['conne']->query($sql_insert)){
            return true;
        }else{
            return false;
        }

    }
    //seleccionar todos los comantarios, por producto
    function select_coments_by_product($id_producto){
        $sql_select="SELECT * FROM comentarios WHERE  Id_producto=".intval($id_producto)." ORDER BY fecha DESC ;";
        $result=$GLOBALS['conne']->query($sql_select);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }
    }
    //Seleccionar comentarios por cliente
    function select_coments_by_client($id_cliente){
        $sql_select="SELECT * FROM comentarios WHERE  comentarios.Id_cliente = ".intval($id_cliente)." ORDER BY fecha DESC ;";
        $result=$GLOBALS['conne']->query($sql_select);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }
    }
    //eliminar un comentario
    function delete_coment($data_coment){
        //este array de $data_coment debe de tener la estructura
        /*
            Id_cliente => 
            Id_producto =>
            fecha =>
        */ 
        $sql_del="DELETE FROM comentarios WHERE ".
        "fecha='".$data_coment['fecha']."' AND Id_cliente=".intval($data_coment['Id_cliente'])." AND Id_producto=".intval($data_coment['Id_producto']).";";
        //DELETE FROM `comentarios` WHERE fecha="2020-12-15 22:48:07" AND Id_cliente=15 AND Id_producto=4
        $result=$GLOBALS['conne']->query($sql_del);
        if($result->num_rows>0){
            return true;
        }else{
            return false;
        }
    }

    //***********************
    //Funciones para los ofertas
    //***********************
    //SELECT * FROM (producto NATURAL JOIN ofertas) WHERE (DAY(CURDATE()) BETWEEN 0 AND 7) AND producto.categoria LIKE 'hombre'
    function sales_by_date($cate){
        $sql_sel="SELECT * FROM (producto NATURAL JOIN ofertas) WHERE (fec_inicio <= NOW() AND fec_fin >= NOW()) AND producto.categoria LIKE '%$cate%' ;";
        $result=$GLOBALS['conne']->query($sql_sel);
        if($result->num_rows>0){
            return $result;
        }else{
            return false;
        }
    }
     //***********************
    //Funciones para los productos
    //***********************

    function select_all_products_without(){
        $sql_sel="SELECT * FROM producto LEFT JOIN ofertas ON producto.ID_producto=ofertas.Id_producto WHERE ofertas.Id_producto IS NULL;";
        $result=$GLOBALS['conne']->query($sql_sel);
        if($result->num_rows>0){
            return $result;
        }else{
            return false;
        }
    }
    //Agregar ofertas
    function new_offer($a_data){
        $sql_insert="INSERT INTO `ofertas`(`Id_producto`,`porcentaje`,`fec_inicio`, `fec_fin`) VALUES ".
        "(".intval($a_data['id_prod']).", ".doubleval($a_data['porcentaje']).", '".$a_data['fecha_ini']."','".$a_data['fecha_fin']."');";
        if($GLOBALS['conne']->query($sql_insert)){
            return true;
        }else{
            return false;
        }

    }
    //retorna todos los posibles chats que hay
    function chats_disponibles(){
        $sql_disp="SELECT usuario.* FROM usuario NATURAL JOIN chat_mensaje GROUP BY chat_mensaje.Id_usuario;";
        $res=$GLOBALS['conne']->query($sql_disp);
        if($res->num_rows>0){
            return $res;
        }else{
            return null;
        }
    }

    //elimina el chat por completo
    function del_chat($id_us){
        $sql_del="DELETE FROM chat_mensaje WHERE Id_usuario=".intval($id_us).";";
        if($GLOBALS['conne']->query($sql_del)){
            return true;
        }else{
            return false;
        }

    }

?>