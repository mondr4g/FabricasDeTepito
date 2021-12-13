<?php
    include 'DB_connection.php';
    //asignacion de la conexion a mysql como una variable global para que sea accesible dentro de este archivo.
    $GLOBALS['conne']=$conne;

    //*********************** 
    //Funciones para estadisticas
    //***********************
    //funcion que regresa total de compras realizadas por genero
    function getSalesByGender() {
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM ver_compras_genero");
        oci_execute($stid);
        oci_close($GLOBALS['conne']);
        return $stid;
    }

    //funcion que regresa total de compras realizadas por genero
    function getSalesBySize() {
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM ver_compras_talla");
        oci_execute($stid);
        oci_close($GLOBALS['conne']);
        return $stid;
    }

    //funcion que regresa total de compras realizadas por genero
    function getSalesByCategory() {
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM ver_compras_categoria");
        oci_execute($stid);
        oci_close($GLOBALS['conne']);
        return $stid;
    }

    //funcion que regresa total de compras realizadas por genero
    function getBestProducts() {
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM ver_productos_vendidos");
        oci_execute($stid);
        oci_close($GLOBALS['conne']);
         return $stid;
    }

    //funcion que regresa total de compras realizadas por genero
    function getBestProductsByOffer() {
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM ver_productos_vendidos_reb");
        oci_execute($stid);
        oci_close($GLOBALS['conne']);
        return $stid;
    }

    //funcion que regresa total de compras realizadas por genero
    function getBestProductsByLaunch() {
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM ver_productos_vendidos_new");
        oci_execute($stid);
        oci_close($GLOBALS['conne']);
        return $stid;
    }

    //*********************** 
    //Funciones para el login
    //***********************
    //SELECT * FROM `producto` NATURAL JOIN `descripcion_producto` WHERE descripcion_producto.talla='xs'
    //funcion para obtener el usuario
    function validate_user($username,$password){
        echo("Aqui");
        $usuario=null;
        //$sql_select = "SELECT * FROM persona WHERE username = '$username';";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM persona WHERE username = '$username'");
        oci_execute($stid);
        $usuario = oci_fetch_array($stid, OCI_ASSOC);

        //$result = $GLOBALS['conne']->query($sql_select);
        if ($usuario) {
            if (sha1($password)!=$usuario['PASS']) {
                return null;
            }
            /*if ($password!=$usuario['PASS']) {
                return null;
            }*/
            
            return $usuario;
        }else{
            return $usuario;
        }
    }

    function select_user_id($username){
        $usuario=null;
        //$sql_select = "SELECT * FROM usuario WHERE username = '$username';";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM persona WHERE username = '$username'");
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
        //$sql_select_client= "SELECT * FROM cliente WHERE id_persona = '$id_usuario';";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM cliente WHERE id_persona = '$id_usuario'");
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
        //$sql_select_admin= "SELECT * FROM administrador WHERE Id_admin = '$id_usuario' ;";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM administrador WHERE id_persona = '$id_usuario'");
        oci_execute($stid);
        $ad = oci_fetch_array($stid, OCI_ASSOC);
        
        if($ad){
            return $ad;
        }else{
            return null;
        }
    }

    //funcion que retorna un usuario
    function select_user($id_usuario){
        //$sql_select_admin= "SELECT * FROM usuario WHERE Id_usuario = '$id_usuario' ;";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM persona WHERE id_persona = '$id_usuario'");
        oci_execute($stid);
        $ad = oci_fetch_array($stid, OCI_ASSOC);
        
        if($ad){
            return $ad;
        }else{
            return null;
        }
    }

    //funcion para recuperar admin de ventas
    function select_sales_admin(){
        //$sql_sel="SELECT * FROM usuario INNER JOIN administrador ON usuario.Id_usuario=administrador.Id_admin WHERE administrador.rol='ventas'";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM persona p JOIN administrador a ON a.id_persona = p.id_persona WHERE a.rol = 'ventas'");
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
        echo(var_dump($user_data));
        //echo "<script type=\"text/javascript\">alert(\"Producto eliminado".var_dump($user_data)." de carritos exitosamente\");</script>";
        $sql = 'BEGIN 
                PERSONAS_PACK.insert_usuario(
                    :username, 
                    :pass,
                    :email,
                    :p_nombre,
                    :s_nombre,
                    :ape_pat,
                    :ape_mat,
                    :fec_nac,
                    :telefono,
                    :pais,
                    :estado,
                    :ciudad,
                    :colonia,
                    :cod_postal,
                    :calle,
                    :numero,
                    :num_interior,
                    :rol,
                    :sexo,
                    :tipo_persona
                ); 
            END;';
        
        $stmt = oci_parse($GLOBALS['conne'], $sql);
     
        //Bind de inputs
        oci_bind_by_name($stmt,":username",$user_data['username']);
        oci_bind_by_name($stmt,":pass",sha1($user_data['password']));
        oci_bind_by_name($stmt,":email",$user_data['email']);
        oci_bind_by_name($stmt,":p_nombre",$user_data['nom_1']);
        oci_bind_by_name($stmt,":s_nombre",$user_data['nom_2']);
        oci_bind_by_name($stmt,":ape_pat",$user_data['ape_1']);
        oci_bind_by_name($stmt,":ape_mat",$user_data['ape_2']);
        oci_bind_by_name($stmt,":fec_nac",$user_data['fec_nac']);
        oci_bind_by_name($stmt,":telefono",$user_data['tel']);
        oci_bind_by_name($stmt,":pais",$user_data['pais']);
        oci_bind_by_name($stmt,":estado",$user_data['estado']);
        oci_bind_by_name($stmt,":ciudad",$user_data['ciudad']);
        oci_bind_by_name($stmt,":colonia",$user_data['colonia']);
        oci_bind_by_name($stmt,":cod_postal",$user_data['codigo']);
        oci_bind_by_name($stmt,":calle",$user_data['calle']);
        oci_bind_by_name($stmt,":numero",$user_data['num_ext']);
        oci_bind_by_name($stmt,":num_interior",$user_data['num_int']);
        oci_bind_by_name($stmt,":rol",$user_data['rol']);
        oci_bind_by_name($stmt,":sexo",$user_data['genero']);
        oci_bind_by_name($stmt,":tipo_persona",$user_data['tipoo']);

        
        
        // Execute the statement
        if(oci_execute($stmt) == true){
            return true;
        }else{
            return false;
        }

        
        
    }
    //inertar administrador
    function insert_admin($id_user, $rol){
        $sql_insert="INSERT INTO `administrador`(`Id_admin`,`rol`) VALUES (".intval($id_user).",'$rol');";
        if($GLOBALS['conne']->query($sql_insert)){
            echo "<script>alert('No se inserto ni mergas')</script>";
            return true;
        }else{
            echo "<script>alert('No se inserto ni mergas')</script>";
        }
    }
    //insertar clientes
    function insert_client($id_user,$genero,$gustos){
        $sql_insert="INSERT INTO `cliente`(`Id_cliente`, `gustos`,`genero`) VALUES ".
        "(".intval($id_user).",'$gustos','$genero');";
        $GLOBALS['conne']->query($sql_insert);
    }


    //RECUPERAR TODOS LOS CLIENTES
    function select_all_clients(){
        //$sql_select_client="SELECT * FROM usuario INNER JOIN cliente ON usuario.Id_usuario=cliente.Id_cliente;";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM persona p JOIN cliente c ON c.id_persona=p.id_persona");
        oci_execute($stid);
        
        return $stid;
    }

    //busqueda de cliente por username
    function search_client_by_name($username){
        //$sql_bus="SELECT * FROM usuario NATURAL JOIN cliente WHERE usuario.username LIKE '%$username%';";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM persona p NATURAL JOIN cliente c WHERE p.username LIKE '%$username%'");
        $result=$GLOBALS['conne']->query($sql_bus);
        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return null;
        }
    }

    //busqueda de admin por username
    function search_admin_by_name($username){
        //$sql_bus="SELECT * FROM usuario NATURAL JOIN administrador WHERE usuario.username LIKE '%$username%';";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM persona p NATURAL JOIN administrador a WHERE p.username LIKE '%$username%'");
        $result=$GLOBALS['conne']->query($sql_bus);
        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return null;
        }
    }

    //buscar usuario por username
    function search_user_by_usname($usname){
        //$sql_select="SELECT * FROM usuario WHERE ".
        //"usuario.username='".$usname."';";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM persona p WHERE p.username = '$usname'");
        $result=$GLOBALS['conne']->query($sql_select);
        if($result->num_rows>0){
            return true;
        }else{
            return false;
        }
    }

    //recuperar todos los administradores
    function select_all_admins(){
        //$sql_select_client="SELECT * FROM usuario INNER JOIN administrador ON usuario.Id_usuario=administrador.Id_admin;";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM persona p JOIN administrador a ON a.id_persona = p.id_persona");
        oci_execute($stid);

        return $stid;
    }

    //recuperar un admin especifico
    function get_admin($id_admin){
        //$sql_sel="SELECT * FROM usuario NATURAL JOIN administrador NATURAL JOIN direcciones WHERE usuario.Id_usuario=".intval($id_admin).";";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM persona p JOIN administrador a ON a.id_persona = p.id_persona JOIN direccion d ON d.id_direccion = p.id_direccion WHERE p.id_persona = ". intval($id_admin));
        oci_execute($stid);
        
        $result=oci_fetch_array($stid, OCI_ASSOC);
        if($result){
            return $result;
        }else{
            return null;
        }
    }

    //recuperar un cliente especific
    function get_client($id_client){
        //$sql_sel="SELECT * FROM usuario NATURAL JOIN cliente NATURAL JOIN direcciones WHERE usuario.Id_usuario=".intval($id_client).";";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM persona p JOIN cliente c ON c.id_persona = p.id_persona JOIN direccion d ON d.id_direccion = p.id_direccion WHERE p.id_persona = " . intval($id_client));
        oci_execute($stid);
        
        $result=oci_fetch_array($stid, OCI_ASSOC);
        if($result){
            return $result;
        }else{
            return null;
        }
    }

    //funcion para eliminar cualquier usuario, se supone que la base de datos realiza una eliminacion e actualizacion en cascada
    function delete_user($id_usuario){
        $sql_del=oci_parse($GLOBALS['conne'],"DELETE FROM PERSONA WHERE id_persona=".intval($id_usuario).";");
        if(oci_execute($sql_del)){
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
        //$sql_select = "SELECT * FROM producto WHERE producto.status=1;";
        $stid = oci_parse($GLOBALS['conne'],"SELECT inv.id_producto, p.nombre, img.ruta, inv.precio FROM producto p JOIN imagen_producto img_pro ON img_pro.id_producto = p.cod_producto JOIN imagen img ON img.id_imagen = img_pro.id_imagen JOIN inventario inv ON inv.id_producto = p.cod_producto WHERE p.status = 'Y' GROUP BY inv.id_producto, p.nombre, img.ruta, inv.precio");
        oci_execute($stid);
        
        return $stid;
    }
    //Retorna un producto de acuerdo al ID que se recibe como parametro.
    function especific_product($id_product){
        $producto=null;
        //$sql_select="SELECT * FROM producto WHERE ID_producto = ".intval($id_product).";";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM producto p JOIN detalle_producto dpo ON dpo.id_detalle = p.id_detalle JOIN inventario inv ON inv.id_producto = p.cod_producto JOIN marca m ON m.id_marca = dpo.id_marca JOIN imagen_producto img_pro ON img_pro.id_producto = p.cod_producto JOIN imagen img ON img.id_imagen = img_pro.id_imagen WHERE p.cod_producto = " . intval($id_product));
        oci_execute($stid);
        
        $result=oci_fetch_array($stid, OCI_ASSOC);
        if($result){
            $producto=$result;
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
        $sql_updt=oci_parse($GLOBALS['conne'],"UPDATE PRODUCTO SET nombre= '".$prod_data['nombre']."',status='".$prod_data['status']."' WHERE p.cod_producto=".intval($prod_data['id'])."");
        if(oci_execute($sql_updt, OCI_NO_AUTO_COMMIT))return false;

        $sql_updt=oci_parse($GLOBALS['conne'],"UPDATE DETALLE_PRODUCTO SET descripcion= '".$prod_data['descp']."',fecha_lanzamiento=TO_DATE(".$prod_data['fecl'].",'YYYY-MM-DD'),id_marca='".$prod_data['marca']."' WHERE id_detalle=".$prod_data['id_det']."");
        if(!oci_execute($sql_updt, OCI_NO_AUTO_COMMIT))return false;

        $sql_updt=oci_parse($GLOBALS['conne'],"UPDATE IMAGEN SET titulo='".$prod_data['titulo']."',ruta='".$prod_data['path']."',fecha_creacion=TO_DATE(".$prod_data['fecc'].",YYYY-MM-DD),descripcion='".$prod_data['desci']."' WHERE id_imagen=".$prod_data['id_img']."");
        if(!oci_execute($sql_updt, OCI_NO_AUTO_COMMIT))return false;

        $sql_updt=oci_parse($GLOBALS['conne'],"UPDATE CATEGORIA_PRODUCTO SET id_categoria=".$prod_data['categoria']." WHERE id_producto=".intval($prod_data['id'])."");
        if(!oci_execute($sql_updt, OCI_NO_AUTO_COMMIT))return false;

        $i = 0;
        foreach($prod_data['tallas'] as $tallarin){
            $sql_updt = oci_parse($GLOBALS['conne'],"UPDATE INVENTARIO SET stock=".intval($prod_data['newstock'][$i]).",precio=".intval($prod_data['precio'])." WHERE id_producto=".intval($prod_data['id'])." AND talla='".$tallarin."';");
            if(!oci_execute($sql_updt, OCI_NO_AUTO_COMMIT))return false;
            $i++;
        }

        oci_commint($GLOBALS['conne']);
        return true;
    }



    //funcion para el prodcuto mas caro
    function producto_mas(){
        //$sql_prod="SELECT * FROM producto WHERE producto.precio = MAX(producto.precio);";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM producto pro JOIN inventario inv ON inv.id_producto = pro.cod_producto WHERE inv.precio = MAX(inv.precio)");
        $result=$GLOBALS['conne']->query($sql_prod);
        if ($result->num_rows>0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function producto_menos(){
        //funcion para el prodcuto mas barato
        //$sql_prod="SELECT * FROM producto WHERE producto.precio = MIN(producto.precio);";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM producto pro JOIN inventario inv ON inv.id_producto = pro.cod_producto WHERE inv.precio = MIN(inv.precio)");
        $result=$GLOBALS['conne']->query($sql_prod);
        if ($result->num_rows>0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }    
    //funcion para seleccionar productos de acuerdo a los filtros
    function products_by_price($min, $max){
        //$sql_prod="SELECT * FROM producto WHERE producto.precio BETWEEN $min AND $max;";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM producto pro JOIN inventario inv ON inv.id_producto = pro.cod_producto WHERE inv.precio BETWEEN $min AND $max");
        $result=$GLOBALS['conne']->query($sql_prod);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }
    }

    //obtener productos por categoria

    function products_by_cat($cat){
        //$sql_select="SELECT * FROM producto WHERE producto.categoria LIKE '%$cat%';";
        $stid = oci_parse($GLOBALS['conne'],"SELECT inv.id_producto, pro.nombre, img.ruta, inv.precio FROM categoria cat JOIN categoria_producto cat_pro ON cat_pro.id_categoria = cat.id_categoria  JOIN producto pro ON pro.cod_producto = cat_pro.id_producto JOIN inventario inv ON inv.id_producto = pro.cod_producto  JOIN imagen_producto img_pro ON img_pro.id_producto = pro.cod_producto  JOIN imagen img ON img.id_imagen = img_pro.id_imagen JOIN detalle_producto dpo ON dpo.id_detalle = pro.id_detalle  WHERE cat.nombre = '$cat' GROUP BY inv.id_producto, pro.nombre, img.ruta, inv.precio");
        oci_execute($stid);
        
        if($stid){
            return $stid;
        }else{
            return null;
        }
    }

    //obtener rebajas
    function get_rebajas(){
        //$sql_ofertas="SELECT * FROM ofertas WHERE fec_inicio <= NOW() AND fec_fin >= NOW();";
        $stid = oci_parse($GLOBALS['conne'],"SELECT inv.id_producto, p.nombre, img.ruta, inv.precio FROM oferta ofe JOIN producto p ON p.cod_producto = ofe.id_producto JOIN inventario inv ON inv.id_producto = p.cod_producto  JOIN imagen_producto img_pro ON img_pro.id_producto = p.cod_producto  JOIN imagen img ON img.id_imagen = img_pro.id_imagen  JOIN detalle_producto dpo ON dpo.id_detalle = p.id_detalle  WHERE ofe.fecha_inicio <= TO_DATE(sysdate,'dd/mm/yyy') AND ofe.fecha_fin >= TO_DATE(sysdate,'dd/mm/yyy') GROUP BY inv.id_producto, p.nombre, img.ruta, inv.precio");
        oci_execute($stid);
        
        if($stid){
            return $stid;
        }else{
            return null;
        }
    }

    //obtener nuevos lanzamientos
    function get_newProds(){
        //$sql_news="SELECT * FROM producto WHERE MONTH(fecha_lanzamiento) = MONTH(CURDATE());";
        $stid = oci_parse($GLOBALS['conne'], "SELECT inv.id_producto, p.nombre, img.ruta, inv.precio FROM producto p JOIN inventario inv ON inv.id_producto = p.cod_producto JOIN imagen_producto img_pro ON img_pro.id_producto = p.cod_producto JOIN imagen img ON img.id_imagen = img_pro.id_imagen JOIN detalle_producto dpo ON dpo.id_detalle = p.id_detalle WHERE TO_CHAR(dpo.fecha_lanzamiento,'mm') = TO_CHAR(sysdate,'mm') GROUP BY inv.id_producto, p.nombre, img.ruta, inv.precio");
        oci_execute($stid);
        
        if($stid){
            return $stid;
        }else{
            return null;
        }
    }



    //funcion para retornar el stock dependiendo de la talla que reciba
    function product_stock($id_prod, $talla){
        //$sql_prod_stock="SELECT JSON_EXTRACT(tallas,'$.$talla') as STOCK FROM producto WHERE producto.ID_producto = ".intval($id_prod)." ;";
        $stid = oci_parse($GLOBALS['conne'],"SELECT inv.stock FROM inventario inv WHERE inv.id_producto = '$id_prod' AND inv.talla = '$talla'");
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
        //$sql_cat="SELECT cliente.genero FROM cliente WHERE Id_cliente=".intval($id_cliente).";";
        $stid = oci_parse($GLOBALS['conne'],"SELECT cli.sexo FROM cliente cli WHERE cli.cod_cliente = " . intval($id_cliente));
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
        $st=intval($stock)-intval($cantidad);
        $sql_updt=oci_parse("UPDATE INVENTARIO SET stock=stock-".$st." WHERE id_producto=".$id_prod." AND talla='".$talla."';");
        $res = oci_execute($sql_updt);
        if($res){
            return true;
        }else{
            echo "error";
            return false;
        }
    }

    //eliminar un producto.
    function delete_product($id_prod){
        $sql_del=oci_parse($GLOBALS['conne'],"DELETE FROM PRODUCTO WHERE cod_producto=".intval($id_prod));
        if(oci_execute($sql_del)){
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
        //$sql_sel="SELECT * FROM detalle_compra INNER JOIN producto ON detalle_compra.Id_producto=producto.ID_producto WHERE Id_compra = ".intval($id_compra)." GROUP BY detalle_compra.Id_producto;";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM detalle_compra dco JOIN producto pro ON pro.cod_producto = dco.id_producto WHERE dco.id_producto = " . intval($id_compra) . "GROUP BY dco.id_producto");
        $result=$GLOBALS['conne']->query($sql_sel);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }

    }

    function get_sale($id_compra){
        //$sql_sel="SELECT * FROM compra WHERE Id_compra=".intval($id_compra).";";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM compra com WHERE com.id_compra = " . intval($id_compra));
        $result=$GLOBALS['conne']->query($sql_sel);
        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return null;
        }
    }

    function obtain_pass($id_user){
        //$sql_obta="SELECT passw FROM usuario WHERE Id_usuario=".intval($id_user).";";
        $stid = oci_parse($GLOBALS['conne'],"SELECT per.pass FROM persona per WHERE per.id_persona = " . intval($id_user));
        oci_execute($stid);
        $result=oci_fetch_array($stid, OCI_ASSOC);

        
        if($result){
            return $result;
        }else{
            return null;
        }
    }

    //UPDATE `usuario` as u NATURAL JOIN cliente as c SET `num_interior`='A6', c.genero='Hombre' WHERE Id_usuario=1
    //faltan
    function modify_cliente($a_data){
        //UPDATE usuario AS u INNER JOIN cliente AS c ON u.Id_usuario=c.Id_cliente INNER JOIN direcciones AS d ON u.Id_usuario=d.Id_usuario SET d.estado='Aguas', c.gustos='caca', u.telefono='000000000'
        
        $sql_update=oci_parse($GLOBALS['conne'],"UPDATE PERSONA SET username='".$a_data['username']."', pass='".$a_data['password']."', email='".$a_data['email']."',p_nombre='".$a_data['nom_1']."',s_nombre='".$a_data['nom_2']."',ape_pat='".$a_data['ape_1']."',ape_mat='".$a_data['ape_2']."',fec_nac=TO_DATE(".$a_data['fec_nac'].",'YYYY-MM-DD'),telefono='".$a_data['tel']."' WHERE id_persona=".intval($a_data['id'])." ");
        

        if(oci_execute($sql_update, OCI_NO_AUTO_COMMIT)){
            $sql_update=oci_parse($GLOBALS['conne'],"UPDATE DIRECCION SET ciudad='".$a_data['ciudad']."',colonia='".$a_data['colonia']."',estado='".$a_data['estado']."',calle='".$a_data['calle']."',numero='".$a_data['num_ext']."',num_interior='".$a_data['num_int']."',cod_postal='".$a_data['codigo']."' WHERE id_direccion=".intval($a_data['id_dir'])."");
            if(oci_execute($sql_update, OCI_NO_AUTO_COMMIT)){
                $sql_update=oci_parse($GLOBALS['conne'],"UPDATE CLIENTE SET sexo='".$a_data['sexo']."' WHERE id_persona=".intval($a_data['id'])." ");
                if(oci_execute($sql_update, OCI_NO_AUTO_COMMIT)){
                    echo "si jalo";
                    oci_commit($GLOBALS['conne']);
                    return true;
                }
                return false;
            }
            return false;
        }else{
            echo "no  jalo";
            return false;
        }

    }

    function modify_admin($a_data){
        $sql_update=oci_parse($GLOBALS['conne'],"UPDATE PERSONA SET username='".$a_data['username']."', pass='".$a_data['password']."', email='".$a_data['email']."',p_nombre='".$a_data['nom_1']."',s_nombre='".$a_data['nom_2']."',ape_pat='".$a_data['ape_1']."',ape_mat='".$a_data['ape_2']."',fec_nac=TO_DATE(".$a_data['fec_nac'].",'YYYY-MM-DD'),telefono='".$a_data['tel']."' WHERE id_persona=".intval($a_data['id']));
        if(oci_execute($sql_update, OCI_NO_AUTO_COMMIT)){
            $sql_update=oci_parse($GLOBALS['conne'],"UPDATE DIRECCION SET ciudad='".$a_data['ciudad']."',colonia='".$a_data['colonia']."',estado='".$a_data['estado']."',calle='".$a_data['calle']."',numero='".$a_data['num_ext']."',num_interior='".$a_data['num_int']."',cod_postal='".$a_data['codigo']."' WHERE id_direccion=".intval($a_data['id_dir'])."");
            if(oci_execute($sql_update, OCI_NO_AUTO_COMMIT)){
                oci_commit($GLOBALS['conne']);
                return true;
            }else{
                return false;
            }
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
        //$sql_select="SELECT * FROM comentarios WHERE Id_producto=".intval($id_producto)." ORDER BY fecha DESC ;";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM comentario com WHERE com.id_producto = " . intval($id_producto) . "ORDER BY com.fecha DESC");
        $result=$GLOBALS['conne']->query($sql_select);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }
    }
    //Seleccionar comentarios por cliente
    function select_coments_by_client($id_cliente){
        //$sql_select="SELECT * FROM comentarios WHERE  comentarios.Id_cliente = ".intval($id_cliente)." ORDER BY fecha DESC ;";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM comentario com WHERE com.cod_cliente = " . intval($id_cliente) . "ORDER BY com.fecha DESC");
        $result=$GLOBALS['conne']->query($sql_select);
        if($result->num_rows>0){
            return $result;
        }else{
            return null;
        }
    }
    //eliminar un comentario
    function delete_coment($id_comentario){
        //este array de $data_coment debe de tener la estructura
        /*
            Id_cliente => 
            Id_producto =>
            fecha =>
        */ 
        $sql_del=oci_parse($GLOBALS['conne'],"DELETE FROM COMENTARIO WHERE id_comentario=".intval($id_comentario).";");
        //DELETE FROM `comentarios` WHERE fecha="2020-12-15 22:48:07" AND Id_cliente=15 AND Id_producto=4
        $result=oci_execute($sql_del);
        if($result){
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

    function del_offer($id_us){
        $sql_del=oci_parse($GLOBALS['conne'],"DELETE FROM MENSAJE WHERE id_oferta=".intval($id_oferta).";");
        if(oci_execute($sql_del)){
            return true;
        }else{
            return false;
        }

    }

     //***********************
    //Funciones para los productos
    //***********************

    function select_all_products_without(){
        //$sql_sel="SELECT * FROM producto LEFT JOIN ofertas ON producto.ID_producto=ofertas.Id_producto WHERE ofertas.Id_producto IS NULL;";
        $stid = oci_parse($GLOBALS['conne'],"SELECT * FROM producto pro LEFT JOIN ofertas ofe ON ofe.id_producto = pro.cod_producto WHERE ofe.id_producto IS NULL");
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
        //$sql_disp="SELECT usuario.* FROM usuario NATURAL JOIN chat_mensaje GROUP BY chat_mensaje.Id_usuario;";
        $stid = oci_parse($GLOBALS['conne'],"SELECT men.id_persona, per.username FROM persona per JOIN mensaje men ON men.id_persona = per.id_persona GROUP BY men.id_persona, per.username");
        oci_execute($stid);

        if($stid){
            return $stid;
        }else{
            return null;
        }
    }

    //elimina el chat por completo
    function del_chat($id_us){
        $sql_del=oci_parse($GLOBALS['conne'],"DELETE FROM MENSAJE WHERE id_persona=".intval($id_us).";");
        if(oci_execute($sql_del)){
            return true;
        }else{
            return false;
        }

    }

?>