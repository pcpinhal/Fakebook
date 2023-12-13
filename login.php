<?php 
include_once 'conexao.php';
/*
if(@$_SESSION['id_login'] != "")
{
    header('Location: index.php');

}else{
    $id = "naologado";
}
*/
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
     
            </div>
            <a href="/"><img src="img/fakebook.png" alt="Fakebook" width="350"></a>
       
                
        </header>
        <main>
            <?php
            try
            {
                if(@$_POST["btnEnviar"] == "Entrar")
                {
                    $_POST['btnEnviar'] = "";
                    $login = mysqli_real_escape_string($conexao, $_POST['txtUsuario']);
                    $senha = mysqli_real_escape_string($conexao, $_POST['txtSenha']);
                    $sql = 'SELECT * FROM tb_login WHERE login = "admin" AND senha = "123";';
                    var_dump($login);
                    var_dump($senha);
                    //var_dump($resultado);
                    $resultado = mysqli_query($conexao,$sql);
                    $dados = mysqli_fetch_assoc($resultado);
                    var_dump($dados);
                    if(($dados['login'] == $login) and ($dados['senha'] == $senha))
                    {
                        $_SESSION['id_login'] = $dados['id_login'];
                        header('Location: index.php');
                    }
                }
            }catch(Exception)
            {
                    echo "usuario ou senha incorretos !";
            }            
            ?>
            <form action="login.php" method="post" enctype="multipart/form-data">
                <label for="txtUsuario">usuario:</label>
                <input type="text" name="txtUsuario" id="txtUsuario">
                <br>
                <label for="txtSenha">Senha:</label>
                <input type="password" name="txtSenha" id="txtSenha">
                <br>
                <input type="submit" value="Entrar" id="btnEnviar" name="btnEnviar">
                <input type="reset" value="Limpar">
            </form>  
        </main>
        <footer>
            rodape FIM
        </footer>
    </div>
</body>
</html>