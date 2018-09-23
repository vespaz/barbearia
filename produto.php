<?php

	include("conexao.php");
	
	sleep(2);
	
	$nome_produto = $_POST["nome_produto"];
	$preco = $_POST["preco"];
	$varejo = $_POST["varejo"];
	$qtdMin = $_POST["qtdMin"];
	$desconto = $_POST["desconto"];
	
	$insert = "INSERT INTO produto(nome_produto, preco, varejo, qtdMin, desconto) VALUES ('$nome_produto','$preco', '$varejo', '$qtdMin', '$desconto')";

	mysqli_query($link,$insert) or die("erro");

	$id_inserido = mysqli_insert_id($link);
	echo $link;
	echo $id_inserido;
	
?>