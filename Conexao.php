<?php 

/* $servername = "localhost";
$database = "databasename";
$username = "username";
$password = "password";
// Cria conexão
$conn = mysqli_connect($servername, $username, $password, $database);

// Se a conexão falhar, mostra erro, caso contrario, mostra msg de sucesso
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}
echo "Conectado com sucesso!!";
mysqli_close($conn); */

$servidor = "Localhost";
$database = "id20744900_crunchtimes";
$usuario = "root";
$senha = "root";

$conn = mysqli_connect($servidor, $usuario, $senha, $database);

/* if(!$conn){
    die("Conexão falhou: ".mysqli_connect_error()." mysqli_connect_errno: ".mysqli_connect_errno());
}
echo "Conectado com sucesso!!!"; */



?>