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
						 if($("#brinde").val()!=""){
								var filho = "option[value=" + $("#brinde").val() + "]";
								var brinde = $("#brinde").children(filho).html() ;
						 }
						 else{
							 var brinde = "N/A";
						 }
						 
				     	  var nova_linha =
						 
				     	    "<tr>" +
								"<td>" + $("#servico").val() + "</td>	" +							
								"<td>" + $("#preco").val() + "</td>" +							
								"<td>" + brinde + "</td>" +							
								"<td>" +
									"<button value='" + msg + "' class='btn_alterar'>Alterar</button>" +
									"<button value='" + msg + "' class='btn_excluir'>Remover</button>" +
								"</td>" +							
						    "</tr>";
				          $("table").append(nova_linha);
				          $("#status").html("<b>Cadastrado!!!</b>");
				    })
					
					.fail(function(jqXHR, textStatus, msg){
						
						//alert("Deu erro");
						//alert(textStatus);
						alert(msg);
					});
					
				});
				
				//#################################################################################################
				
				//											ALTERAR
				
				//#################################################################################################
				
				$(document).on('click', '.btn_alterar', function(){
					
					coluna_nome = $(this).closest('tr').children("td.alt_nome");
					nome = coluna_nome.html();
					
					coluna_preco = $(this).closest('tr').children("td.alt_preco");
					preco = coluna_preco.html();
					
					coluna_brinde = $(this).closest('tr').children("td.alt_brinde");
					brinde = coluna_brinde.html();
					
					coluna_nome.html(	"<input type='text' id='alterar_nome' value='"+ nome +"' />");
					coluna_preco.html(	"<input type='text' id='alterar_preco' value='"+ preco +"' />");
					
					$.ajax({
						
						url : "selecionarBrindeAlterar.php",
						type : "get",
						
						beforeSend: function(){
							
							$("#status").html("Estamos alterando o brinde...");
						
						}
						
					})
					
					.done(function(msg){
						$("#status").html("Brinde alterado com sucesso!");
						
						coluna_brinde.html(msg);
					
					});
				
					$(this).html("Finalizar alteração");
					$(this).addClass('btn_alterando');
					$(this).removeClass('btn_alterar');
					
				});
				
				
				//#################################################################################################
				
				//											ALTERARANDO
				
				//
				
				$(document).on('click', '.btn_alterando', function(){
					
					id_alterando = $(this);
					
					coluna_nome =    $(this).closest('tr').children("td.alt_nome");
					coluna_preco =   $(this).closest('tr').children("td.alt_preco");
					coluna_brinde  = $(this).closest('tr').children("td.alt_brinde");
					
					alterar_nome = 	  $(this).closest('tr').children("td.alt_nome").children("input");
					alterar_preco =    $(this).closest('tr').children("td.alt_preco").children("input");
					alterar_brinde  =  $(this).closest('tr').children("td.alt_brinde").children("select");
					
					
					$.ajax({
						
						url : "alterandoServico.php",
						type : "post",
						data : {
							
							id: id_alterando.val(),
							nome: alterar_nome.val(),
							preco: alterar_preco.val(),
							brinde: alterar_brinde.val()
							
						},
						
						beforeSend: function(){
							
							$("#status").html("Estamos alterando...");
						
						}

					})
					
					
					
					.done(function(msg){
						alert(msg);
						$("#status").html("Alterado com sucesso!");
						
						coluna_nome.html(alterar_nome.val());
						coluna_preco.html(alterar_preco.val());
						
						if(alterar_brinde.val()!=""){
								var filho = "option[value=" + alterar_brinde.val() + "]";
								var brinde = alterar_brinde.children(filho).html() ;
						}else{
							 var brinde = "N/A";
						}
						
						coluna_brinde.html(brinde);
						
					})
					
					.fail(function(jqXHR, textStatus, msg){
						
						alert("Algo deu errado :(");
					})
					
					$(this).html("Alterar");
					$(this).addClass('btn_alterar');
					$(this).removeClass('btn_alterando');
				});
				
				//#################################################################################################
				
				//											REMOVER
				
				//
			
				$(document).on("click", ".btn_excluir", function(){
					
					var id=$(this).val();
					var linha_remove = $(this).closest("tr");
					
					$.ajax({
						
						url : "excluirServico.php",
						type : "post",
						data : {
							
							id: id
						},
						
						beforeSend: function(){
							
							$("#status").html("Estamos removendo...");
							
						}
						
					})
					
					.done(function(msg){
						
						if( msg == '1'){
							
							linha_remove.remove();
							$("#status").html("Removido com sucesso!");
							
						}else{
							
							$("#status").html("Erro na remoção!");
							
						}
						
					})
					
				});
				
				//#################################################################################################
				
				//											CADASTRO BRINDE
				
				//
				
				$(document).on("click", "#btnBrinde", function(){
					
					
					$.ajax({
						
						url : "brinde.php",
						type : "post",
						data : {
							
							brinde : $("#brinde").val()
						},
						
						beforeSend: function(){
							
							$("#status").html("Brinde Cadastrado...");
							
						}
						
					})
					
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
		
		<div id="form" class="form">
			
			<label class="label">Nome Serviço: </label>
			<input type="text" name="servico" id="servico"/>
			<br />
			<br />
			
			<label class="label">Preço: </label>
			<input type="number" name="preco" id="preco" step="0.01"/>			
			<br />
			<br />
			<br />
			
			<div id="divBrinde">
				<label class="label">Brinde: </label>
				<?php 
					include ("selecionarBrinde.php");				
				?>
			</div>
			<br />
			<br />
			
			<button id="cadastrar">Cadastrar Novo Serviço</button>
			<br />
			<br />
			
			<label class="label">Adicionar brinde: </label>
			<input type="text" name="brinde" id="brinde" placeholder="Adicionar novo brinde" />
			<button id="btnBrinde">OK</button>
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
						<th>Nome</th>
						<th>Preço</th>
						<th>O que tem direito</th>
						<th>Ação</th>
					</tr>
					
				</thead>
				
				<tbody>
				
					<?php
						
						include("lista_servico.php");
					
					?>
				
				</tbody>
				
			</table>
		
		</div>
		
	</body>
	
</html>