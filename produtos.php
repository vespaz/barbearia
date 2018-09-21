<?php
	include("conexao.php");
	$sql = "SELECT * FROM produto ORDER BY nome_produto";
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
				$("#cadastrarProd").click(function(){
					$.ajax({
						
						url : "produto.php",
						type : 'post',
						data : {
							nome_produto : $("#produto").val(),
							preco : $("#precoProd").val(),
							varejo : $("#varejo").val()
						},
						
						beforeSend : function(){
							$("#status").html("Cadastrando...");
						}
					})
					
					.done(function(msg){
						var nova_linha = 
						
						"<tr>" +
							"<td>" + $("#nome_produto").val() + "</td>" +
							
							"<td>" + $("#precoProd").val() + "</td>" +
							
							"<td>" + $("#varejo").val() + "</td>" +
							
							"<td>" + $("#qtdMin").val() + "</td>" +
							
							"<td>" + $("#desconto").val() + "</td>" +
							
							"<td>" +
							
								"<button value='" + msg + "' class='btn_exculir'>Remover</button>" +
							
							"</td>" +
						"</tr>";
						
						$("table").append(nova_linha);
						$("#status").html("<b>Cadastrado!!!</b>")
					})
					
					.fail(function(jqXHR, textStatus, msg){
						
						alert(msg);
						
					});
					
				});
				
				$("#varejo").click(function(){
       
					$('#esconder').css('visibility', 'hidden');

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
			
			<label class="label">Nome Produto: </label>
			<input type="text" name="produto" id="produto"/>
			<br />
			<br />
			
			<label class="label">Preço: </label>
			<input type="number" name="precoProd" id="precoProd" step="0.01"/>
			<br />
			<br />
			
			<label class="label">Desconto no Varejo: </label>
			<input type="radio" id="varejo" name="varejo" value="sim" />Sim
			<input type="radio" id="varejo" name="varejo" value="nao" checked  />Não
			<br />
			<br />
			
			
			<div id="esconder">
			
				<label class="label" >Quantidade Mínima: </label>
				<input type="number" id="qtdMin" name="qtdMin"  />
				<br />
				<br />
				
				<label class="label">Desconto: </label>
				<input type="number" id="desconto" name="desconto"  />		
				
			</div>
			
			<br />
			<br />
			<button id="cadastrarProd">Cadastrar Novo Produto</button>
			
			<!--Valor unitário: com Desconto pegar a qtd do prduto e * pelo preco. Subtrair o desconto e divide pela qtd-->
			<br />
			<br />
			<br />
			<br />
			<div id="status">Status Operação</div>
		</form>
		
		<table class="table" border="1">
			<thead>
				<tr>
					<th>Nome Produto</th>
					<th>Preço</th>
					<th>Varejo mínimo/ desconto</th>
					<th>Valor unitario com desconto</th>
					<th>Ação</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 
					include "conexao.php";
					
					while($linha=mysqli_fetch_array($resultado)){
						echo "<tr>
								<td class='alt_nome_produto'  value='$linha[id_produto]'>$linha[nome_produto]</td>	
								<td class='alt_preco'  value='$linha[id_produto]'>$linha[preco]</td>
								
								<td class='alt_varejo'  value='$linha[id_produto]'>'" . $linha["qtdMin"] ."' / '" . $linha["desconto"] . "'</td>
								
								<td class='alt_varejo'  value='$linha[id_produto]'>$linha[varejo]</td>
								<td>							
									<button class='btn_alterar' value='$linha[id_produto]'>Alterar</button>
									<button class='btn_excluir' value='$linha[id_produto]'>Remover</button>
								</td>
							</tr>";
					}
				?>
			</tbody>
		</table>
	</body>
</html>