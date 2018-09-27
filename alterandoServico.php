<?php

	include "conexao.php";
	
	$id = $_POST["id"];
	
	$nome = $_POST["nome"];
	$preco = $_POST["preco"];
	$brinde = $_POST["brinde"];
	
	$update	= "UPDATE servico SET nome_servico='$nome', preco='$preco', cod_brinde='$brinde' WHERE id_barbearia='$id'";
	
	mysqli_query($link, $update) or die($update);

?>