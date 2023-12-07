<?php
session_start();

$usuario = "root";
$senha   = "";
$url     = "localhost";
$database= "Fakebook";

try
{
    $conexao = mysqli_connect($url, $usuario, $senha, $database);
}
catch(Exception)
{
    echo 'Erro ao Conectar ao Banco de Dados. <br>Erro:001 ';
    return;
}



?>