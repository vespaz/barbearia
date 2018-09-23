<?php

	include("conexao.php");
	
	$sql = "SELECT * FROM produto";
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
				
				$("#esconder").hide();
				
				$("#cadastrarProd").click(function(){
					
					$.ajax({
						
						url : "produto.php",
						type : 'post',
						data : {
							nome_produto : $("#produto").val(),
							preco : $("#precoProd").val(),
							varejo : $(".varejo:checked").val(),
							qtdMin : $("#qtdMin").val(),
							desconto : $("#desconto").val()
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
						$("#status").html("<b>Cadastrado!!!</b>");
						
						alert("Deu certo!!");
						
					})
					
					.fail(function(jqXHR, textStatus, msg){
						
						alert("Deu erro");
						alert(textStatus);
						
					});
					
				});
				
				$(".varejo").click(function(){
					
					var selecionado = $(".varejo:checked").val();
					
					if( selecionado == 's' ){
						
						$("#esconder").show();
						
					}else{
						
						$("#esconder").hide();
						
					}

				});
				
				//#################################################################################################
				
				//											ALTERAR
				
				//#################################################################################################
				
				$(document).on('click', '.btn_alterar', function(){
					
    				coluna_nome = $(this).closest('tr').children("td.alt_nome");
			    	nome = coluna_nome.html();
					
			    	coluna_preco = $(this).closest('tr').children("td.alt_preco");
					preco = coluna_preco.html();
					
			    	coluna_unitario = $(this).closest('tr').children("td.alt_unit");
					unitario = coluna_unitario.html();
					
			    	coluna_desconto = $(this).closest('tr').children("td.alt_desc");
					desconto = coluna_desconto.html();
					
			    	coluna_descontao = $(this).closest('tr').children("td.alt_desct");
					descontao = coluna_descontao.html();
					
			    	coluna_nome.html(		"<input type='text'   id='alterar_nome'  value='"+ nome +"' />");
			    	coluna_preco.html(		"<input type='number' id='alterar_preco' value='"+ preco +"' />");
			    	coluna_unitario.html(	"<input type='text' id='alterar_unit'  value='"+ unitario +"' />");
			    	coluna_desconto.html(	"<input type='text' id='alterar_desc'  value='"+ desconto +"' />");
			    	
			    	$(this).html("Finalizar alteração");
			    	$(this).addClass('btn_alterando');
     				$(this).removeClass('btn_alterar');
					
			    });
				
				//*************************************************************************************************
				//											ALTERANDO
				
				$(document).on('click', '.btn_alterando', function(){
					
					id_alterando = $(this);
					
					coluna_nome = 		$(this).closest('tr').children("td.alt_nome");
			    	coluna_preco = 		$(this).closest('tr').children("td.alt_preco");
			    	coluna_unitario = 	$(this).closest('tr').children("td.alt_unit");
			    	coluna_desconto = 	$(this).closest('tr').children("td.alt_desc");
			    	coluna_descontao = 	$(this).closest('tr').children("td.alt_desct");
					
					alterar_nome = 		$(this).closest('tr').children("td.alt_nome").children("input");
			    	alterar_preco = 	$(this).closest('tr').children("td.alt_preco").children("input");
			    	alterar_unitario = 	$(this).closest('tr').children("td.alt_unit").children("input");
			    	alterar_desconto = 	$(this).closest('tr').children("td.alt_desc").children("input");
					
					$.ajax({
						
						url : "alterando.php",
						type : "post",
						data : {
							
							id: id_alterando.val(),
							nome: alterar_nome.val(),
							preco: alterar_preco.val(),
							unitario: alterar_unitario.val(),
							desconto: alterar_desconto.val()
							
						},
						
						beforeSend : function(){
							
							$("#status").html("Estamos alterando...");
							
						}
						
					})
					
					.done(function(msg){
						
						$("#status").html("Alterando com sucesso!");
						
						coluna_nome.html(alterar_nome.val());
						coluna_preco.html(alterar_preco.val());
						coluna_unitario.html(alterar_unitario.val());
						coluna_desconto.html(alterar_desconto.val());
						coluna_descontao.html(msg);
						
					})
					
					.fail(function(jqXHR, textStatus, msg){
						
						alert("Algo deu errado :(");	
						
					});
					
					$(this).html("Alterar");
					$(this).addClass('btn_alterar');
					$(this).removeClass('btn_alterando');
					
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
			<input type="radio" id='varejo' class="varejo" name="varejo" value="s" />Sim
			<input type="radio" id='varejo' class="varejo" name="varejo" value="n" checked  />Não
			<br />
			<br />
			
			
			<div id="esconder">
			
				<label class="label" >Quantidade Mínima: </label>
				<input type="number" id="qtdMin" name="qtdMin" step="1.0" />
				<br />
				<br />
				
				<label class="label">Desconto: </label>
				<input type="number" id="desconto" name="desconto"  />
				<br />
				<br />
				
			</div>
			
			<br />
			<button id="cadastrarProd">Cadastrar Novo Produto</button>
			
			<!--Valor unitário: É subitrair o preço total do desconto unitário. o desconto unitátio é preço total vezes o desconto em %.-->
			
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
					<th colspan='2'>Varejo mínimo / Desconto (%)</th>
					<th>Valor unitario com desconto</th>
					<th>Ação</th>
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
				
					while($linha=mysqli_fetch_assoc($resultado)){
						
						if( $linha["varejo"] == "s" ){
							
							$descontao = $linha["preco"] - ($linha["preco"] * ($linha["desconto"] / 100));
							$qtdMin = $linha["qtdMin"];
							$desconto = $linha["desconto"];
							
						}else{
							
							$qtdMin = "N/A";
							$desconto = "N/A";
							$descontao = "N/A";
							
						}
						
						echo "<tr>
								<td class='alt_nome'  value='$linha[id_produto]'>$linha[nome_produto]	</td>	
								<td class='alt_preco' value='$linha[id_produto]'>$linha[preco]</td>
								<td class='alt_unit'  value='$linha[id_produto]'>$qtdMin</td>
								<td class='alt_desc'  value='$linha[id_produto]'>$desconto</td>
								<td class='alt_desct' value='$linha[id_produto]'>$descontao</td>
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