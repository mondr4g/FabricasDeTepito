<?php
    //Aqui se realizara la recarga de los productos, utilizando AJAX.
    include '../Carrito/carrito.php';
    
    if(isset($_POST['json']) ){//Aqui recibiremos el JSON que contendra los filtros y la bandera para saber si se mostraran todos los productos o solo los de JSON
        //Aqui haremos la implementacion de las busquedas mediante cada uno de los filtros que recibamos.
?>
    <!--Aqui metes lo que falte para el css-->
<!DOCTYPE html> 
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Liverpuri Official</title>
    <link rel="stylesheet" type="text/css" href="../style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../resp.css?v=<?php echo time(); ?>">
    <script type="text/javascript" src="../JS/catalog.js?v=<?php echo time(); ?>"></script>
</head>
<body>
<main>
    <div class="products" style="margin-top: 0">
<?php


        $products_to_show=null;
        //filtros
        $filters=$_POST['json'];
        $filters=json_decode($filters);
        //print_r(json_decode($filters));

        //$filters=$_POST['json'];
        $str_filtrado="";
        //para encontrar la categoria sobre la cual buscar
        $categoria=$filters->categoria;
        $rebajas=$filters->rebajas;
        $nuevos=$filters->nuevos;
        if ($filters->band==true) {
            
            if ($rebajas==true) {
                $str_filtrado="SELECT * FROM producto as p NATURAL JOIN ofertas as o WHERE";  
            } else {
                $str_filtrado="SELECT * FROM producto as p WHERE";
            }
        
            $b_first=true;
            $bb_first=true;


            if($categoria=="null"){
                if ($b_first) {
                    $str_filtrado=$str_filtrado." (p.precio >=".doubleval($filters->minPrice)." AND p.precio <= ".doubleval($filters->maxPrice).")";
                    $b_first=false;
                }else{
                    
                    $str_filtrado=$str_filtrado." AND p.precio >=".doubleval($filters->minPrice)." AND p.precio <= ".doubleval($filters->maxPrice).")";
                    
                }
            }else{
                if ($b_first) {
                    $str_filtrado=$str_filtrado." (p.categoria = '$categoria' AND p.precio >=".doubleval($filters->minPrice)." AND p.precio <= ".doubleval($filters->maxPrice).")";
                    $b_first=false;
                }else{
                    $str_filtrado=$str_filtrado." AND p.categoria = '$categoria' AND p.precio >=".doubleval($filters->minPrice)." AND p.precio <= ".doubleval($filters->maxPrice).")";
                }
                
            }

            if($rebajas){
                
                if($b_first){
                    $str_filtrado=$str_filtrado."(";
                    $str_filtrado=$str_filtrado." o.fec_inicio <= NOW() AND o.fec_fin >= NOW()";
                    $b_first=false;
                }else{
                    $str_filtrado=$str_filtrado." AND (";
                    $str_filtrado=$str_filtrado." o.fec_inicio <= NOW() AND o.fec_fin >= NOW()";
                }

                $str_filtrado=$str_filtrado.")";
            }

            if($nuevos){
                if($b_first){
                    $str_filtrado=$str_filtrado."(";
                    $str_filtrado=$str_filtrado." MONTH(fecha_lanzamiento) = MONTH(CURDATE())";
                    $b_first=false;
                }else{
                    $str_filtrado=$str_filtrado." AND (";
                    $str_filtrado=$str_filtrado." MONTH(fecha_lanzamiento) = MONTH(CURDATE())";
                }

                $str_filtrado=$str_filtrado.")";

            }
            
            $seguns=true;
            if($filters->playera==true || $filters->pantalon==true || $filters->chamarra==true || $filters->sudadera==true || $filters->abrigo){
                $str_filtrado=$str_filtrado." AND (";
                if($filters->playera==true ){//filtros para el tipo
                    if ($seguns) {
                        if($categoria=="null"){
                            $str_filtrado=$str_filtrado." p.tipo LIKE '%playera%'";
                        }else{
                            $str_filtrado=$str_filtrado." (p.tipo LIKE '%playera%' AND p.categoria LIKE '%$categoria%')";
                        }
                        
                        $seguns=false;
                    }else{
                        if($categoria=="null"){
                            $str_filtrado=$str_filtrado." OR p.tipo LIKE '%playera%'";
                        }else{
                            $str_filtrado=$str_filtrado." OR (p.tipo LIKE '%playera%' AND p.categoria LIKE '%$categoria%')";
                        }
                        
                    }
                }
                if($filters->pantalon==true){
                    if($seguns){
                        if($categoria=="null"){
                            $str_filtrado=$str_filtrado." p.tipo LIKE '%pantalon%'";
                        }else{
                            $str_filtrado=$str_filtrado." (p.tipo LIKE '%pantalon%' AND p.categoria LIKE '%$categoria%')";
                        }
                        
                        $seguns=false;
                    }else{
                        if($categoria=="null"){
                            $str_filtrado=$str_filtrado." OR p.tipo LIKE '%pantalon%' ";
                        }else{
                            $str_filtrado=$str_filtrado." OR (p.tipo LIKE '%pantalon%' AND p.categoria LIKE '%$categoria%')";
                        }
                        
                    }
                }
                if($filters->chamarra==true){
                    if($seguns){
                        if($categoria=="null"){
                            $str_filtrado=$str_filtrado." p.tipo LIKE '%chamarra%'";
                        }else{
                            $str_filtrado=$str_filtrado." (p.tipo LIKE '%chamarra%' AND p.categoria LIKE '%$categoria%')";
                        }
                        
                        $seguns=false;
                    }else{
                        if($categoria=="null"){
                            $str_filtrado=$str_filtrado." OR p.tipo LIKE '%chamarra%'";
                        }else{
                            $str_filtrado=$str_filtrado." OR (p.tipo LIKE '%chamarra%' AND p.categoria LIKE '%$categoria%')";
                        }
                        
                    }
                    
                }
                if($filters->sudadera==true){
                    if($seguns){
                        if($categoria=="null"){
                            $str_filtrado=$str_filtrado." p.tipo LIKE '%sudadera%'";
                        }else{
                            $str_filtrado=$str_filtrado." (p.tipo LIKE '%sudadera%' AND p.categoria LIKE '%$categoria%')";
                        }
                        
                        $seguns=false;
                    }else{
                        if($categoria=="null"){
                            $str_filtrado=$str_filtrado." OR p.tipo LIKE '%sudadera%'";
                        }else{
                            $str_filtrado=$str_filtrado." OR (p.tipo LIKE '%sudadera%' AND p.categoria LIKE '%$categoria%')";
                        }
                        
                    }
                    
                }
                if($filters->abrigo==true){
                    if($seguns){
                        if($categoria=="null"){
                            $str_filtrado=$str_filtrado." p.tipo LIKE '%abrigo%'";
                        }else{
                            $str_filtrado=$str_filtrado." (p.tipo LIKE '%abrigo%' AND p.categoria LIKE '%$categoria%')";
                        }
                        
                        $seguns=false;
                    }else{
                        if($categoria=="null"){
                            $str_filtrado=$str_filtrado." OR p.tipo LIKE '%abrigo%'";
                        }else{
                            $str_filtrado=$str_filtrado." OR (p.tipo LIKE '%abrigo%' AND p.categoria LIKE '%$categoria%')";
                        }
                        
                    }
                    
                }
                $str_filtrado=$str_filtrado.")";
            }
            $seguns=true;
            
            if($filters->XS==true || $filters->S==true || $filters->M==true || $filters->L==true || $filters->XL==true){
                $str_filtrado=$str_filtrado."AND (";
                $tal="";
                if($filters->XS){
                    $tal="XS";
                    if($seguns){
                        //aplicar correcciones a query
                        $str_filtrado=$str_filtrado.' JSON_EXTRACT(p.tallas,"$.XS") > 0';
                        $seguns=false;
                    }else{

                        $str_filtrado=$str_filtrado.' OR JSON_EXTRACT(p.tallas,"$.XS")> 0';
                    }
                }
                if($filters->S){
                    if($seguns){
                        $tal="S";
                        $str_filtrado=$str_filtrado.' JSON_EXTRACT(p.tallas,"$.S") > 0';
                        $seguns=false;
                    }else{
                        $str_filtrado=$str_filtrado.' OR JSON_EXTRACT(p.tallas,"$.S") > 0';
                    }
                }
                if($filters->M){
                    $tal="M";
                    if($seguns){
                        $str_filtrado=$str_filtrado.' JSON_EXTRACT(p.tallas,"$.M") > 0';
                        $seguns=false;
                    }else{
                        $str_filtrado=$str_filtrado.' OR JSON_EXTRACT(p.tallas,"$.M") > 0';
                    }
                }
                if($filters->L){
                    $tal="L";
                    if($seguns){
                        $str_filtrado=$str_filtrado.' JSON_EXTRACT(p.tallas,"$.L") > 0';
                        $seguns=false;
                    }else{
                        $str_filtrado=$str_filtrado.' OR JSON_EXTRACT(p.tallas,"$.L") > 0';
                    }
                }
                if($filters->XL){
                    $tal="XL";
                    if($seguns){
                        $str_filtrado=$str_filtrado.' JSON_EXTRACT(p.tallas,"$.XL") > 0';
                        $seguns=false;
                    }else{
                        $str_filtrado=$str_filtrado.' OR JSON_EXTRACT(p.tallas,"$.XL") > 0';
                    }
                }
                $str_filtrado=$str_filtrado.")";
            }

            

            $str_filtrado=$str_filtrado.";";
            
        }else{
            if($categoria!="null"){
                $str_filtrado="SELECT * FROM producto WHERE producto.status=1 AND producto.categoria LIKE '%$categoria%'";
            }elseif($nuevos){
                $str_filtrado="SELECT * FROM producto WHERE producto.status=1 AND  MONTH(fecha_lanzamiento) = MONTH(CURDATE())";
            }elseif($rebajas){
                $str_filtrado="SELECT * FROM producto NATURAL JOIN ofertas WHERE producto.status=1 ";
            }else{
                $str_filtrado="SELECT * FROM producto WHERE producto.status=1 ";
            }
            $str_filtrado=$str_filtrado." AND (precio >=".doubleval($filters->minPrice)." AND precio <= ".doubleval($filters->maxPrice).")";

        }


        //EJECUCION DE LA CONSULTA
        echo $str_filtrado;
        $products_to_show=$GLOBALS['conne']->query($str_filtrado);
        if ($products_to_show->num_rows > 0) {
            foreach($products_to_show as $prod){
                 //$prod, en esta variable viene la info de cada producto recuperado. si se quieren visualizar todos los productos.
                    $imgs=json_decode($prod['imgs']);
                 if($rebajas){
                    //Aqui muestras los productos cuando se buscan por rebajas
?>
        <div class="item-box">
            <form action="" method="POST">
                <div class="img-item">
                    <a href="vista_producto.php?id_del_prod=<?php echo $prod['ID_producto'] ?>"><img class="imgi" src="<?php echo $imgs->I1 ?>" alt="item1"></a> 
                </div>
                <div class="description">
                    <h4 name="nombre"><?php echo $prod['nombre']?></h4>
                    <p name="precio"><?php echo $prod['precio']?> $MXN</p>
                    <div class="info-item">
                        <input type="hidden" name="nombre" value="<?php echo $prod['nombre']?>">
                        <input type="hidden" name="precio" value="<?php echo $prod['precio']?>">
                        <input type="hidden" name="ID" value="<?php echo $prod['ID_producto'] ?>">
                        <input type="hidden" name="CANT" value="1">
                        <input type="hidden" name="talla" value="M">
                    </div>
                        <?php if (isset($_SESSION['admin_on']) || isset($_SESSION['client_on'])) {?>
                    <button class="buy" name="btnAction" value="Agregar">Add</button>
                    <?php } ?>
                </div>
            </form>
        </div>
                    <!-- HOLa-->
<?php

                }else{
                    //Aqui pones los productos asi normal.
?>

<div class="item-box">
            <form action="" method="POST">
                <div class="img-item">
                    <a href="vista_producto.php?id_del_prod=<?php echo $prod['ID_producto'] ?>"><img class="imgi" src="<?php echo $imgs->I1 ?>" alt="item1"></a> 
                </div>
                <div class="description">
                    <h4 name="nombre"><?php echo $prod['nombre']?></h4>
                    <p name="precio"><?php echo $prod['precio']?> $MXN</p>
                    <div class="info-item">
                        <input type="hidden" name="nombre" value="<?php echo $prod['nombre']?>">
                        <input type="hidden" name="precio" value="<?php echo $prod['precio']?>">
                        <input type="hidden" name="ID" value="<?php echo $prod['ID_producto'] ?>">
                        <input type="hidden" name="CANT" value="1">
                        <input type="hidden" name="talla" value="M">
                    </div>
                        <?php if (isset($_SESSION['admin_on']) || isset($_SESSION['client_on'])) {?>
                    <button class="buy" name="btnAction" value="Agregar">Add</button>
                    <?php } ?>
                </div>
            </form>
        </div>
                <!--Aqui Pones los productos-->
<?php
                }
            }
        }else{
            //Aqui hacer algo en caso de caso de que no haya productos.
        }
        
        
    }

?>
</div>
</main>
</body>
</html>