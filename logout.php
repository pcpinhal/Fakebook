<?php 
include_once 'conexao.php';
session_destroy();
header('Location: index.php');
?>
