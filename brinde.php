<?php

	include("conexao.php");
	
	$brinde = $_POST["brinde"];
	
	$insert = "INSERT INTO brinde (brinde) VALUES ('$brinde')";

	mysqli_query($link, $insert) or die( mysqli_error($link) );

	$id_inserido = mysqli_insert_id($link);
	
	echo $id_inserido;
	
?>