<?php @SESSION_START();
	if (!isset($_SESSION['client_on']) && !isset($_SESSION['admin_on'])) {
	echo "<script>location.href='index.php'</script>";	
	exit(0);
	}
	include ("../DB_FUNCTIONS/DB_connection.php");


	if ($result = $conne->query("SELECT * FROM `chat_mensaje`
	WHERE `Id_usuario` = ".$_SESSION['chat']." ORDER BY `chat_mensaje`.`Id_chat_msj` DESC")) {
		while($row = $result->fetch_row()){
			if($row[4]==0){
				printf("<p><div class=\"left\"><span class=\"mensaje\">%s</span><br><span class=\"fecha\">%s</span></div></p>", $row[2], $row[3]);
			}
			else{
				printf("<p><div align=\"right\"><div class=\"right\"><span class=\"mensaje\">%s</span><br><span class=\"fecha\">%s</span></div></div></p>", $row[2], $row[3]);
			}
		}
		$result->close();
	}
	$conne->close();
?>