<?php

//CONEÃO_____________________________________________________________________________________________________________________________
	$conexao = mysqli_connect("localhost","root","","cadastros");
//___________________________________________________________________________________________________________________________________	
//CONSULTA DO FILTRO
if(!empty($_GET['filterSql'])){
    $filterSql = $_GET['filterSql'];
	$resultadoFilter = mysqli_query($conexao,$filterSql);
}else{
    $resultadoFilter = null;
}

//___________________________________________________________________________________________________________________________________	
//EXIBIXÃO DE TODAS AS COLUNAS E LINHAS______________________________________________________________________________________________
	$sql = "SELECT * FROM people";
	$resultado = mysqli_query($conexao,$sql);
//___________________________________________________________________________________________________________________________________	
// Realizar a consulta MySQL para obter os IDs
$sqlId = "SELECT id FROM cadastros.people";
$resultadoId = mysqli_query($conexao, $sqlId);

if ($resultadoId && mysqli_num_rows($resultadoId) > 0) {
    $options = []; // Array para armazenar os IDs

    // Iterar sobre os resultados
    while ($registro = mysqli_fetch_assoc($resultadoId)) {
        // Acessar o valor do campo ID
        $id = $registro['id'];

        // Adicionar o ID ao array "options"
        $options[] = $id;
    }
} 

mysqli_free_result($resultadoId);

//___________________________________________________________________________________________________________________________________	
?>
<html>
<link rel="stylesheet" type="text/css" href="estilo.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<head>
</head>
<body class="fundo">	
<!------------------------------FORMULÁRIO DE CADASTRO------------------------------------------------------------------------------->
<div class="container">
	<h2>CADASTRO</h2>
	<form action='recebe_add.php' method='post' >
		<table class="table table-dark table-hover"border="5">
			<tr>
				<td> name <input  type='text' name='txt_name'/></td>
				<td> city <input type='text' name='txt_city'/></td>
				<td> Tell <input type='text' name='txt_tell' /></td>
				<td> email <input type='text' name='txt_email' /></td>
				<td><button type='submit' value='enviar'>ENVIAR</button></td>
			</tr>
		</table>

	</form>
</div>
	
<!----------------------------------------------------------------------------------------------------------------------------------->

<!------------------------------TABELA DE VISUALISAÇÃO------------------------------------------------------------------------------->
<div class="container">
	<h2>VISUALIZAR TODOS</h2>
	<table class="table table-dark table-hover" border="5">
		<tr>
			<th> Id</th>
			<th> name</th>
			<th> city</th>
			<th> Tell</th>
			<th> email</th>
			<?php 
				while($linha = mysqli_fetch_array($resultado)){					
					echo "<tr>";
					echo "<td>".$linha["id"]."</td>";
					echo "<td>".$linha["name"]."</td>";
					echo "<td>".$linha["city"]."</td>";
					echo "<td>".$linha["tell"]."</td>";
					echo "<td>".$linha["email"]."</td>";
					echo "</tr>";
					//$linha = mysqli_fetch_array ($resultado)
					// A variavel $linha vira um array matriz da variavel $resultado, onde o name de cada coluna é o indece do Array 
					// o while é feito para percorrer todo o array da $linha
				}
			?>
		</tr>
	</table>
</div>

<!----------------------------------------------------------------------------------------------------------------------------------->

<!---------------------------------TABELA DE PESQUISA-------------------------------------------------------------------------------->
<div class="container">

	<h2>BUSCAR POR COlUNA </h2>
	<form action="recebe_filter.php" method="get">
		<input name="buscar" placeholder="digite os termos de pesquisa" type="text">
		<button type="submit"> PESQUISAR</button>
		<table class="table table-dark table-hover" border="5">
		<tr>
			<th> Id</th>
			<th> name</th>
			<th> city</th>
			<th> Tell</th>
			<th> email</th>
            <?php
              if(!empty($resultadoFilter))
              {
                    while($linha = mysqli_fetch_array($resultadoFilter)){
                        echo "<tr>";
                        echo "<td>".$linha["id"]."</td>";
                        echo "<td>".$linha["name"]."</td>";
                        echo "<td>".$linha["city"]."</td>";
                        echo "<td>".$linha["tell"]."</td>";
                        echo "<td>".$linha["email"]."</td>";
                        echo "</tr>";
                        //$linha = mysqli_fetch_array ($resultado)
                        // A variavel $linha vira um array matriz da variavel $resultado, onde o name de cada coluna é o indece do Array 
                        // o while é feito para percorrer todo o array da $linha
                    }
                }
            ?>  
		</tr>
		</table>
    </form>
</div>
<!----------------------------------------------------------------------------------------------------------------------------------->
<div class="container">
<h2>EDITAR LINHA POR ID</h2>
<form action='recebe_edit.php' method='post' >
		<table class="table table-dark table-hover" border="5">
			<tr>		
                <td>			
                <select name="opcao">
                    <?php foreach ($options as $option) { ?>
                    <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                    <?php } ?>
                </select>
                </td>        
                <td> name <input  type='text' name='txt_name'/></td>
				<td> city <input type='text' name='txt_city'/></td>
				<td> Tell <input type='text' name='txt_tell' /></td>
				<td> email <input type='text' name='txt_email' /></td>
				<td><button type='submit' value='editar'>EDITAR</button></td>
			</tr>
		</table>
</form>
</div>

<div class="container">
<h2>EXCLUIR LINHA POR ID</h2>
<form action='recebe_delete.php' method='post' >
		<table class="table table-dark table-hover" border="5">
			<tr>					
				<td>
					<select>
						<option>Id</option>
					<option>
				</td>		
				<td> name <input  type='text' name=''/></td>
				<td> city <input type='text' name=''/></td>
				<td> Tell <input type='text' name='' /></td>
				<td> email <input type='text' name='' /></td>
				<td><button type='submit' value='editar'>EDITAR</button></td>
			</tr>
		</table>
</form>
</div>
</body>
</html>