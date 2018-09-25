<?php

	include("conexao.php");
	
	sleep(2);
	
	$nome_produto = $_POST["nome_produto"];
	$preco = $_POST["preco"];
	$varejo = $_POST["varejo"];
	$qtdMin = $_POST["qtdMin"];
	$desconto = $_POST["desconto"];
	
	if( $qtdMin == '' || $desconto == '' ){
		
		$qtdMin = 'N/A';
		$desconto = 'N/A';
		$descontao = $preco;
		
	}else{
		
		$descontao = $preco - ($preco * ($desconto / 100));
		
	}
	
	
	$insert = "INSERT INTO produto(nome_produto, preco, varejo, qtdMin, desconto, descontao) VALUES ('$nome_produto','$preco', '$varejo', '$qtdMin', '$desconto', '$descontao')";

	mysqli_query($link,$insert) or die($insert);

	$id_inserido = mysqli_insert_id($link);
	echo $id_inserido;
	
?>