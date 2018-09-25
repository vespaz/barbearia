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
						
						$("#status").html("Cadastrado com sucesso!");
						
						if( $("#qtdMin").val() == '' || $("#desconto").val() == ''){
							
							var qtdMin = 'N/A';
							var desconto = 'N/A';
							
							var descontao = 'N/A';
							
						}else{
							
							var qtdMin =  $("#qtdMin").val() ;
							var desconto = $("#desconto").val();
							
							var descontao = parseInt($("#precoProd").val()) - ( parseInt($("#precoProd").val()) * ( parseInt($("#desconto").val()) / 100));
							
						}
						
						var nova_linha = 
						
						"<tr>" +
							"<td class='alt_nome' >" + $("#produto").val() + "</td>" +
							
							"<td class='alt_preco' >" + $("#precoProd").val() + "</td>" +
							
							"<td class='alt_unit' >" + qtdMin + "</td>" +
							
							"<td class='alt_desc' >" + desconto + "</td>" +
							
							"<td class='alt_desct' >" + descontao + "</td>" +
							
							"<td>" +
							
								"<button value='" + msg + "' class='btn_alterar'>Alterar</button>" +
								"<button value='" + msg + "' class='btn_excluir'>Remover</button>" +
							
							"</td>" +
						"</tr>";
						
						$("table").append(nova_linha);
						
						// alert(msg);
						
					})
					
					.fail(function(jqXHR, textStatus, msg){
						
						//alert("Deu erro");
						alert(jqXHR.responseText);
						
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
				
				//#################################################################################################
				
				//											REMOVER
				
				//#################################################################################################
				
				$(document).on("click", ".btn_excluir", function(){
					
					var id = $(this).val();
					var linha_remove = $(this).closest("tr");
					
					$.ajax({
						
						url : "excluir.php",
						type : "post",
						data : {
							
							id: id
							
						},
						
						beforeSend : function(){
							
							$("#status").html("Estamos removendo...");
							
						}
						
					})
					
					.done(function(msg){
						
						if( msg == '1' ){
							
							linha_remove.remove();
							$("#status").html("Removido com sucesso!");
							
						}else{
							
							$("#status").html("Não é possível remover este produto. Esta vinculado à um brinde!");
							
						}
						
					})
					
				});
				
			});
			
		</script>
		
	</head>
	
	<body>
	
		<div class="img"><img src="barba.png" /></div>
		
		<p class="a">
			<button><a href="index.php">Serviços</a></button>
			<button><a href="produtos.php">Produtos</a></button>
		</p>
		
		<div id="form" class="form">
			
			<label class="label">Nome Produto: </label>
			<input type="text" name="produto" id="produto"/>
			<br />
			<br />
			
			<label class="label">Preço: </label>
			<input type="number" name="precoProd" id="precoProd" step="0.1"/>
			<br />
			<br />
			
			<label class="label">Desconto no Varejo: </label>
			<input type="radio" id='varejo' class="varejo" name="varejo" value="s" /><label class="label2">Sim</label>
			<input type="radio" id='varejo' class="varejo" name="varejo" value="n" checked  /><label class="label2">Não</label>
			<br />
			<br />
			
			
			<div id="esconder" style="display:none">
			
				<label class="label" >Quantidade Mínima: </label>
				<input type="number" id="qtdMin" name="qtdMin" step="0.1" />
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
			
		</div>
		
		
		<div class="table_css">
		
			<div id="status" class="status">Status Operação</div>
			
			<br />
		
			<table class="table">
			
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
								
								$descontao = $linha["descontao"];
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
		
		</div>
		
		<br />
		<br />
		<br />
		
	</body>
	
</html>