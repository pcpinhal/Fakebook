<?php 
include_once 'conexao.php';
if(@$_SESSION['id_login'] != "")
{
    $id = $_SESSION['id_login'];    
}else{
    $id = "naologado";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fakebook - seu site de noticias</title>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="/img/conta.png" alt="logo" width="125" height="125">
                <h4>NOME DE USUÁRIO</h4>
            </div>
            <nav>
                <ul>
                    <li><a href="login.php">LOGIN</a></li>
                    <li><a href="perfil.php">PERFIL</a></li>
                    <li><a href="logout.php">SAIR</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="enviar">

            </div>
            <article>

            </article>
        </main>
    </div>
</body>
</html>