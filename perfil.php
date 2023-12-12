<?php 
include_once 'conexao.php';
if(@$_SESSION['id_login'] != "")
{
    $id = $_SESSION['id_login'];    
}else{
    header('Location: index.php');
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
                if($id!="")
                {                    
                    $sql = "SELECT * FROM tb_login WHERE id_login = $id;";
                    $resultado = mysqli_query($conexao, $sql);
                    $dados = mysqli_fetch_assoc($resultado);                    
                    echo '<img src="/img/'. $dados['foto'] .'" alt="logo" width="125" height="125">';
                    echo '<h4>'. $dados['nome'] .'</h4>';
                }
                ?>                
            </div>
            <img src="img/fakebook.png" alt="Fakebook" width="350">
            <?php 
            if($id!="")
            {           
                echo'
                <nav>
                    <ul>                        
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
            <?php
                if(@$_POST['btnAtualizar'] == "Atualizar")
                {                    
                    $login = $_POST['txtLogin'];
                    $senha = $_POST['txtSenha'];
                    $nome = $_POST['txtNome'];
                    $sql = "UPDATE tb_login SET login = '$login', senha = '$senha', nome = '$nome' WHERE id_login = $id";
                    $resultado = mysqli_query($conexao, $sql);                    
                    if($resultado === TRUE)
                    {
                        echo "Atualizado<br>";
                        // var_dump($_FILES);
                        if($_FILES['txtImagem']['full_path'] != "")
                        {
                            echo "salva foto<br>";
                            $a = "teste";
                            $uploaddir = 'img/';
                            $nomearquivo = $_FILES['txtImagem']['name'];
                            $uploadfile = $uploaddir . basename($a.$nomearquivo);
                            
                            if (move_uploaded_file($_FILES['txtImagem']['tmp_name'], $uploadfile)) {
                                echo "Arquivo válido e enviado com sucesso.\n";
                                $sql = "UPDATE tb_login SET foto= '$nomearquivo' WHERE id_login = $id";
                                $resultado = mysqli_query($conexao, $sql);
                            } else {
                                echo "Possível ataque de upload de arquivo!\n";
                            }

                        }else{
                            echo "Não salva foto !!!<br>";
                        }
                    }else{
                        echo "Não atualizado<br>";
                    }                    
                }
            ?>          
            <form action="perfil.php" method="post" enctype="multipart/form-data">
                <?php
                $sql = "SELECT * FROM tb_login WHERE id_login = $id;";
                $resultado = mysqli_query($conexao, $sql);
                $dados = mysqli_fetch_assoc($resultado);            
                ?>
                id: <?php echo $dados['id_login'];?><br>
                <label for="txtLogin">Login</label>
                <input type="text" name="txtLogin" id="txtLogin" value="<?php echo $dados['login'];?>">
                <br>
                <label for="txtSenha">Senha</label>
                <input type="password" name="txtSenha" id="txtSenha" value="<?php echo $dados['senha'];?>">
                <br>
                <label for="txtNome">Nome:</label>
                <input type="text" name="txtNome" id="txtNome" value="<?php echo $dados['nome'];?>">
                <br>
                <label for="txtImagem">Foto</label>               
                <input type="file" name="txtImagem" id="txtImagem" accept="image/png, image/jpeg">                
                <br>
                <input type="submit" value="Atualizar" name="btnAtualizar" id="btnAtualizar"> 
            </form>
        </main>
        <footer>
            rodape FIM
        </footer>
    </div>
</body>
</html>