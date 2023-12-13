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
                    echo '<img src="/img/'. $dados['foto'] .'" alt="logo" width="125" height="125">';
                    echo '<h4>'. $dados['nome'] .'</h4>';
                }else{
                    echo '<p class="inscrever"><a href="cadastrar.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Inscrever</a></p>';
                }
                ?>                
            </div>
            <a href="/"><img src="img/fakebook.png" alt="Fakebook" width="350"></a>
            <?php 
            if($id!="naologado")
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
            if($id!="naologado"){
                echo '
                    <form action="index.php" method="post" enctype="multipart/form-data">
                        <div class="enviar">                
                            <div class="foto">
                                <img src="img/foto.png" alt="Foto">
                                <input type="file" name="btnFoto" id="btnFoto" accept="image/*" title="&nbsp;">
                            </div>
                            <div class="msg">
                                <textarea id="txtMsg" name="txtMsg" rows="9" cols="118" placeholder="Diga algo sobre ..."></textarea>
                                <!-- <i class="fa fa-paper-plane-o" aria-hidden="true"></i> -->
                                <input type="submit" value="Enviar" id="btnEnviar" name="btnEnviar">
                            </div>                
                        </div>                
                    </form>
                ';    
            }   
            ?>
            <?php
                if(@$_POST['btnEnviar'] == "Enviar")
                {
                    $_POST['btnEnviar'] = '';
                    $de = $_POST['txtMsg'];
                    if($_FILES['btnFoto']['full_path'] != "")
                    {                                                 
                        $nome_aleatorio = date('dmYHis')."F";
                        $uploaddir = 'img/';
                        $nomearquivo = $_FILES['btnFoto']['name'];
                        $uploadfile = $uploaddir . basename($nome_aleatorio.$nomearquivo);                            
                        if (move_uploaded_file($_FILES['btnFoto']['tmp_name'], $uploadfile)) {                            
                            $sql = "INSERT INTO tb_noticia (noticia, fk_de, imagem) VALUES ('$de', '$id', '$nomearquivo');";                            
                        } else {
                            echo "Possível ataque de upload de arquivo!\n";
                        }
                    }else{
                        $sql = "INSERT INTO tb_noticia (noticia, fk_de) VALUES ('$de', '$id');";                                                
                    }
                    $resultado = mysqli_query($conexao, $sql);
                    if($resultado === TRUE)
                    {
                        echo "Noticia inserida com sucesso !";
                    }
                }  
            ?>
            <?php
            $sql = "SELECT * FROM tb_noticia 
                    INNER JOIN tb_login
                    ON tb_noticia.fk_de = tb_login.id_login
                    ORDER BY id_noticia DESC;";
            $resultado = mysqli_query($conexao, $sql);
            while($dados = mysqli_fetch_assoc($resultado))
            {
                if ($dados["foto"]=="")
                    $dados["foto"] = "conta.png";
                if ($dados["imagem"]=="")
                $dados["imagem"] = "foto.png";
                echo '
                <article>            
                    <div class="de">
                        foto: <img src="img/'.$dados["foto"].'" alt="" width=125/><br>
                        quem mandou:'.$dados["nome"].'<br>
                        data e hor: '.$dados["datahora"].'
                    </div>
                    <div class="mensagem">
                        a mensagem: '.$dados["noticia"].'
                    </div>
                    <div class="imagem">
                        imagem:<img src="img/'.$dados["imagem"].'" alt="" width=400/>
                    </div>
                </article>
                ';
            } 
            ?>            
        </main>
        <footer>
            rodape FIM
        </footer>
    </div>
</body>
</html>