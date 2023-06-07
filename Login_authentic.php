<?php

include('Conexao.php');

$usuario = $_POST['txt_usuario'];
$senha = $_POST['txt_senha'];

$sql_logar=mysqli_query($conn, "SELECT *FROM Usuario WHERE email='$usuario' and senha='$senha'" );

if(mysqli_num_rows($sql_logar)!=0){



    header("Location: loginChecked.php?user=$usuario");

} 
else{
    echo"<script>alert('Usuário Não Registrado');
    window.location.href='login.php';
    </script>";
   /* header('Location: login.php'); */
}
?>
