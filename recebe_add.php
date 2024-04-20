<?php

//conexão com o banco de dados.
$conexao = mysqli_connect("localhost","root","","cadastros");

//Variaveis recebidas da index.
$name = $_POST['txt_id'];
$name = $_POST['txt_name'];
$city = $_POST['txt_city'];
$phone = $_POST['txt_tell'];
$email = $_POST['txt_email'];
//Variavel que contem a ação de enserir dados no campo.
$sql = "INSERT INTO people (name, city, tell, email)
             VALUES ('$name','$city','$phone','$email')";
//Exibe os dados da variavel selecionada.

//Função que passa os dados para dentro do banco.
//Primeiro parâmetro é a variavel que esta salvo a conexao, o segundo é a instrução sql que vai ser passada.
mysqli_query($conexao,$sql);

//Redirecionamento 
header ("location:index.php");
?>