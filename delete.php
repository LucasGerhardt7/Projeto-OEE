<?php
session_start();
include_once("Conexao.php");
$id = $_GET['id'];
if(!empty($id)){
	$result_usuario = "DELETE FROM Producao WHERE id='$id'";
	$resultado_usuario = mysqli_query($conn, $result_usuario);
	if(mysqli_affected_rows($conn)){
	    $_SESSION['msg'] = "<p style='color:green;'>Usuário apagado com sucesso</p>";
		header("Location:loginChecked.php");
	}else{
	    $_SESSION['msg'] = "<p style='color:red;'>Erro o usuário não foi apagado com sucesso</p>";
		header("Location:loginChecked.php");
	}
}else{
    $_SESSION['msg'] = "<p style='color:red;'>Necessário selecionar um usuário</p>";
	header("Location:loginChecked.php");
}
?>