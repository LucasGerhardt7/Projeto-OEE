<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Crunch Times</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <!-- Início do formulário -->
    <form method="post" action="Login_authentic.php" class="form">
        <div class="card">
            <div class="card-top">
                <img class="imglogin" src=imagens/logoChocolate.png alt=""><!-- imagem Logo -->
                <figcaption>Sugar High</figcaption>
                <h2 class="title">Login</h2> <!-- Titulo embaixo da imagem-->
            </div>
            <!--Campo do email e css de classe "card-group"-->
            <div class="card-group">
                <label>Email</label>
                <input type="email" name="txt_usuario" placeholder="Digite seu email">
            </div>
            <!--Campo do senha e css de classe "card-group"-->
            <div class="card-group">
                <label>Senha</label>
                <input type="password" name="txt_senha" placeholder="Digite sua senha">
            </div>

            <div class="card-group btn"><!--Campo classe "card-group btn" onde faz o efeito do mouse passando por cima do botão aceesar fazendo ele ficar cinza-->
                <button type="submit">ACESSAR</button>
               
                <a href="index.php" class="cadastrar">Retornar</a><!--links que redireciona o usuario para a tela principal"index.html"-->
            </div>
        </div>
    </form>

</body>
</html>