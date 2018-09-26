<?php
	
	include("conexao.php");
	
	$id = $_POST["id"];

	$delete = "DELETE FROM produto WHERE id_produto = '$id' ";

	mysqli_query($link,$delete) or die("erro");

	echo "1";

?>