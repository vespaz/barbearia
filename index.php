<?php

	include("conexao.php");
	
	$sql = "SELECT * FROM servico";
	$resultado = mysqli_query($link,$sql) or die("erro");

?>
<!DOCTYPE html>

<html lang="pt-Br">

	<head>
	
		<meta charset="UTF-8"/>
		<title>Index da Barbearia</title>
		<link rel="stylesheet" type="text/css" href="css.css">
		
		<script src="jquery-3.3.1.min.js"></script>
		
		<script>
		
			$(document).ready(function(){ 
			
				$("#cadastrar").click(function(){
					
					///////////////// CADASTRO //////////////
					$.ajax({
						
						url : "servico.php",
						type : 'post',
						data : {
							nome_servico : $("#servico").val(),
							preco : $("#preco").val(),
							brinde : $("#brinde").val()
						},
						
						beforeSend : function(){
							
			               $("#status").html("Cadastrando...");
						   
						}
					})
					
					.done(function(msg){
				     	  var nova_linha =
						  
				     	    "<tr>" +
								"<td>" + $("#nome_servico").val() + "</td>	" +							
								"<td>" + $("#preco").val() + "</td>" +							
								"<td>" + $("#brinde").val() + "</td>" +							
								"<td>" +														
									"<button value='" + msg + "' class='btn_excluir'>Remover</button>" +
								"</td>" +							
						    "</tr>";
				          $("table").append(nova_linha);
				          $("#status").html("<b>Cadastrado!!!</b>");
				    })
					
					.fail(function(jqXHR, textStatus, msg){
						
						alert("Deu erro");
						alert(textStatus);
						alert(msg);
						
					});
					
				});
			
			});
			
		</script>
		
	</head>
	
	<body>
	
		<img src="barba.png" />
		
		<p class="a">
			<button><a href="index.php">Serviços</a></button>
			<button><a href="produtos.php">Produtos</a></button>
		</p>
		
		<form id="form" class="form">
			
			<label class="label">Nome Serviço: </label>
			<input type="text" name="servico" id="servico"/>
			<br />
			<br />
			
			<label class="label">Preço: </label>
			<input type="number" name="preco" id="preco" step="0.01"/>
			<br />
			<br />
			
			<label class="label">Adicionar brinde: </label>
			<input type="text" name="brinde" id="brinde" placeholder="Adicionar novo brinde" />
			
			<br />
			<br />
			<button id="cadastrar">Cadastrar Novo Serviço</button>
			
			<br />
			<br />
			<br />
			<br />
			<div id="status">Status Operação</div>
		</form>
		
		<table class="table">
		
			<thead>
			
				<tr>
					<th>Nome</th>
					<th>Preço</th>
					<th>O que tem direito</th>
					<th>Ação</th>
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
				
					while($linha=mysqli_fetch_assoc($resultado)){
						
						echo "<tr>
								<td class='alt_'  value='$linha[id_barbearia]'>$linha[nome_servico]</td>	
								<td class='alt_'  value='$linha[id_barbearia]'>$linha[preco]</td>
								<td class='alt_'  value='$linha[id_barbearia]'>$linha[brinde]</td>
								<td>							
									<button class='btn_alterar' value='$linha[id_barbearia]'>Alterar</button>
									<button class='btn_excluir' value='$linha[id_barbearia]'>Remover</button>
								</td>
							  </tr>";
							  
					}
				
				?>
			
			</tbody>
			
		</table>
		
	</body>
	
</html>