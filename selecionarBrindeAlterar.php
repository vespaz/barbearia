<?php 
	include ("conexao.php");
	$select = "SELECT * FROM brinde order by brinde";
	$resultado = mysqli_query($link, $select);
	
	echo "<select class='alterar_brinde'>";
		echo "<option value=''>:: Selecionar::</option>";
		
		while($linha = mysqli_fetch_array($resultado)){
			echo "<option value='" . $linha["id_brinde"] . "'>" . $linha["brinde"] . "</option>";
		}
	echo "</select>";
?>