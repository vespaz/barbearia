<?php

	include("conexao.php");
	
	$nome_servico = $_POST["nome_servico"];
	$preco = $_POST["preco"];
	$brinde = $_POST["brinde"];

	$insert = "INSERT INTO servico(nome_servico, preco, brinde) VALUES ('$nome_servico','$preco', '$brinde')";

	mysqli_query($link,$insert) or die("erro");

	$id_inserido = mysqli_insert_id($link);
	echo $id_inserido;
?>