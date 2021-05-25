<?php 
    include_once("conexao.php");
    //verifica se foi logado ou não
    verificaUsuario();

    //recebendo dados
    $cpf = $_POST['txtcpf'];
    $nome = $_POST['txtnome'];
    $senha = md5($_POST['txtsenha']);

    $insert = @mysqli_query($conexao, "UPDATE usuario set NOME = '$nome', SENHA = '$senha' WHERE CPF = '$cpf'");

    //instruções
    if (!$insert) {
        die('Query inválida' . @mysqli_error($conexao));
    } else {
        header('Location: index.php?txtpesquisar=');
    }

    //fechando conexao
    mysqli_close($conexao);
?>