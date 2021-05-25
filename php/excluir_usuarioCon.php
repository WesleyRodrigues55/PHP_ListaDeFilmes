<?php
    include_once("conexao.php");

    //recebe dados
    $cpf = $_POST['txtcpf'];
    $nome = $_POST['txtnome'];
    $senha = md5($_POST['txtsenha']);

    $excluir = @mysqli_query($conexao, "DELETE FROM usuario WHERE CPF = '$cpf'");

    //instruções
    if (!$excluir) {
        die('Query inválida: ' . @mysqli_error($conexao));
    } else {
       header('Location: login.php');
    }

    //fechando conexao
    mysqli_close($conexao);
?>