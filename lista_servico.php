<?php 

	include("conexao.php");
	$select = "SELECT * FROM servico INNER JOIN brinde 
				on servico.cod_brinde = brinde.id_brinde order by nome_servico";
				
	$resultado = mysqli_query($link, $select);
	
	while($linha=mysqli_fetch_assoc($resultado)){
		
		echo "<tr>
				<td class='alt_nome'  value='$linha[id_barbearia]'>" . $linha["nome_servico"] . "</td>	
				<td class='alt_preco'  value='$linha[id_barbearia]'>" . $linha["preco"] . "</td>
				<td class='alt_brinde'  value='$linha[id_barbearia]'>" . $linha["brinde"] . "</td>
				<td>							
					<button class='btn_alterar' value='$linha[id_barbearia]'>Alterar</button>
					<button class='btn_excluir' value='$linha[id_barbearia]'>Remover</button>
				</td>
			</tr>";
		  
	}
	
?>