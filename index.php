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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Fakebook - seu site de noticias</title>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <?php
                if($id!="naologado")
                {
                    $sql = "SELECT * FROM tb_login WHERE id_login = $id;";
                    $resultado = mysqli_query($conexao, $sql);
                    $dados = mysqli_fetch_assoc($resultado);
                    echo '<img src="/img/'+ $dados["foto"] +'" alt="logo" width="125" height="125">';
                    echo '<h4>'+ $dados['nome'] +'</h4>';
                }else{
                    echo '<p class="inscrever"><a href="cadastrar.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Inscrever</a></p>';
                }
                ?>                
            </div>
            <img src="img/fakebook.png" alt="Fakebook" width="350">
            <?php 
            if($id!="naologado")
            {           
                echo'
                <nav>
                    <ul>
                        <li><a href="login.php">LOGIN</a></li>
                        <li><a href="perfil.php">PERFIL</a></li>
                        <li><a href="logout.php">SAIR</a></li>
                    </ul>
                </nav>';
            }else{
                echo '<p class="inscrever"><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Entrar</a></p>';
            }               
            ?>            
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