<?php
session_start();

$usuario = "root";
$senha   = "";
$url     = "localhost";
$database= "Fakebook";

try
{
    $conexao = mysqli_connect($url, $usuario, $senha, $database) or die('Erro ao Conectar ao Banco de Dados');
}
catch(Exception $e)
{
    echo 'Erro ao Conectar ao Banco de Dados. <br>Erro: '. $e;
}



?>