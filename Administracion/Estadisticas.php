<?php
    //session_start();

    include '../DB_FUNCTIONS/DB_functions.php';

    //if(isset($_SESSION['admin_on'])){
        //ENSEGUIDA METERLE ESTILOS PARA QUE SE VEA BONITO.
?>

<!DOCTYPE html> 
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Fabricas de Tepito Official</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../CSS/resp.css?v=<?php echo time(); ?>">
</head>
<body>
	<header>
        <nav>
            <a id="main-logo" href="../index.php"><h1 class="logo">Fabricas de Tepito</h1></a>
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
                    <li><a href="index_admin.php">Admin</a></li>
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
        <div class="home-graphics">
            <div class="graphs">
                <div class="graphics">
                    <canvas id="comprasGenero"></canvas>
                </div>
                <div class="graphics">
                    <canvas id="comprasTalla"></canvas>
                </div>
            </div>
            <div class="graphs">
                <div class="graphics">
                    <canvas id="comprasCategoria"></canvas>
                </div>
                <div class="graphics">
                    <canvas id="productoVendido"></canvas>
                </div>
            </div>
            <div class="graphs">
                <div class="graphics">
                    <canvas id="productoVendidoReb"></canvas>
                </div>
                <div class="graphics">
                    <canvas id="productoVendidoNew"></canvas>
                </div>
            </div>
        </div>
	</main>
	<footer>
		<p>&copy; 2020 | Drackode | Aguascalientes, Mexico</p>      	
	</footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // COMPRAS POR GENERO
        var ctx = "comprasGenero";
        const comprasGenero = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                        $result = getSalesByGender();
                        while(($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
                    ?>
                    '<?php echo $row["SEXO"]; ?>',
                    <?php
                        }
                    ?>
                ],
                datasets: [{
                    label: '# de Compras',
                    data: [
                        <?php
                            $result = getSalesByGender();
                            while(($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
                        ?>
                        '<?php echo $row["CANTIDAD"]; ?>',
                        <?php
                            }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Compras Por Genero'
                    }
                }
            },
        });
        
        // COMPRAS POR TALLA 
        ctx = "comprasTalla";
        const comprasTalla = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                        $result = getSalesBySize();
                        while(($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
                    ?>
                    '<?php echo $row["TALLA"]; ?>',
                    <?php
                        }
                    ?>
                ],
                datasets: [{
                    label: '# De Compras',
                    data: [
                        <?php
                            $result = getSalesBySize();
                            while(($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
                        ?>
                        '<?php echo $row["CANTIDAD"]; ?>',
                        <?php
                            }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                // Elements options apply to all of the options unless overridden in a dataset
                // In this case, we are setting the border of each horizontal bar to be 2px wide
                elements: {
                    bar: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: 'Compras Por Talla'
                    }
                }
            },
        }); 
        
        // COMPRAS POR CATEGORIA 
        ctx = "comprasCategoria";
        const comprasCategoria = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    <?php
                        $result = getSalesByCategory();
                        while(($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
                    ?>
                    '<?php echo $row["NOMBRE"]; ?>',
                    <?php
                        }
                    ?>
                ],
                datasets: [{
                    label: '# de Compras',
                    data: [
                        <?php
                            $result = getSalesByCategory();
                            while(($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
                        ?>
                        '<?php echo $row["CANTIDAD"]; ?>',
                        <?php
                            }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Compras por Categoria'
                    }
                }
            },
        }); 
        
        // PRODUCTOS MAS VENDIDOS
        ctx = "productoVendido";
        const procustoVendido = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: [
                    <?php
                        $result = getBestProducts();
                        while(($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
                    ?>
                    '<?php echo $row["NOMBRE"]; ?>',
                    <?php
                        }
                    ?>
                ],
                datasets: [{
                    label: '# De Compras',
                    data: [
                        <?php
                            $result = getBestProducts();
                            while(($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
                        ?>
                        '<?php echo $row["CANTIDAD"]; ?>',
                        <?php
                            }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Productos Mas Vendidos'
                    }
                }
            },
        }); 
        
        // PRODUCTOS MAS VENDIDOS REBAJAS
        ctx = "productoVendidoReb";
        const productoVendidoReb = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    <?php
                        $result = getBestProductsByOffer();
                        while(($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
                    ?>
                    '<?php echo $row["NOMBRE"]; ?>',
                    <?php
                        }
                    ?>
                ],
                datasets: [{
                    label: '# De Compras',
                    data: [
                        <?php
                            $result = getBestProductsByOffer();
                            while(($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
                        ?>
                        '<?php echo $row["CANTIDAD"]; ?>',
                        <?php
                            }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Productos Mas Vendidos Por Rebajas'
                    }
                }
            },
        }); 
        
        // PRODUCTOS MAS VENDIDOS REBAJAS
        ctx = "productoVendidoNew";
        const productoVendidoNew = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    <?php
                        $result = getBestProductsByLaunch();
                        while(($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
                    ?>
                    '<?php echo $row["NOMBRE"]; ?>',
                    <?php
                        }
                    ?>
                ],
                datasets: [{
                    label: '# De Compras',
                    data: [
                        <?php
                            $result = getBestProductsByLaunch();
                            while(($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
                        ?>
                        '<?php echo $row["CANTIDAD"]; ?>',
                        <?php
                            }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Productos Mas Vendidos Por Lanzamiento'
                    }
                }
            },
        });              
    </script>
</body>
</html>
<?php
    // }
    // else {
    //     header("Location: ../index.php");
    // }
?>