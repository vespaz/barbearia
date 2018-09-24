<?php

	include "conexao.php";
	
	$id = $_POST["id"];
	
	$nome = $_POST["nome"];
	$preco = $_POST["preco"];
	$unitario = $_POST["unitario"];
	$desconto = $_POST["desconto"];
	
	$update	= "UPDATE produto SET nome_produto='$nome',preco='$preco',
				qtdMin='$unitario', desconto='$desconto' WHERE id_produto='$id'";
	
	mysqli_query($link, $update) or die("ERROR in MYSQL");
	
	$descontao = $preco - ($preco * ($desconto / 100));
	echo $descontao;

?>