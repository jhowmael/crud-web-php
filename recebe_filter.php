<?php

$conexao = mysqli_connect("localhost","root","","cadastros");

//PESQUISA___________________________________________________________________________________________________________________________
if(!empty($_GET['buscar'])){
	$pesquisar = $_GET['buscar'];
}
else{
	$_GET['buscar'] = null;
	$pesquisar = $_GET['buscar'];	

}
	$sql = "SELECT * FROM people WHERE id = '$pesquisar' or name = '$pesquisar' or city='$pesquisar' or tell='$pesquisar' or 'email' = '$pesquisar'";
//___________________________________________________________________________________________________________________________________	
$filterSql = $sql;

$pagina_destino = "index.php?filterSql=" . urlencode($filterSql);
header("Location: " . $pagina_destino);
?>

