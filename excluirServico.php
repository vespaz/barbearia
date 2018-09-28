<?php
	
	include("conexao.php");
	
	$id = $_POST["id"];

	$delete = "DELETE FROM servico WHERE id_barbearia = '$id' ";

	mysqli_query($link,$delete) or die("erro");

	echo "1";

?>