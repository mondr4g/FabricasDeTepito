<?php
    session_start();
    include '../DB_FUNCTIONS/DB_functions.php';
    
    if($_POST){
      
                $cliente="";
                if (isset($_SESSION['admin_on'])) {
                    $cliente = $_SESSION['admin_on'];
                }else if(isset($_SESSION['client_on'])){
                    $cliente = $_SESSION['client_on'];
                }else{
                    $cliente="";
                }
                $cl= htmlspecialchars($cliente);
                $pr=$_POST['id_prod'];
                $cm=$_POST['newComment'];
                $array_data=array(
                    "producto" => $pr,
                    "cliente" => $cl,
                    "comentario" => $cm
                );
                
                if(new_coment($array_data)){
                    //si si se envio
                    $coments = select_coments_by_product($pr);
                    foreach($coments as $com){
                        //en $com esta la info de cada comentario relacionado con el producto que llego
                        $user=select_user($cl);

                ?>
                        <!--Aqui mete la impresion del comentario-->
                        <div class="comentario">
                                <div class="info-comment">
                                    <p>Por: <?php echo $user['username']?> </p>
                                    <p><?php echo $com['fecha']?></p>
                                </div>
                                <br>
                                <div class="desc-comment">
                                    <p><?php echo $com['comentario']?></p>
                                </div>
                                <hr>    
                        </div>
                <?php
                    }

                }else{
                    //si no
                }
            
        

    }
?>