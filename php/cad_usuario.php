<?php
    include("conexao.php");

    $nome = $_POST['txtnome'];
    $cpf = $_POST['txtcpf'];
    $senha = md5($_POST['txtsenha']);

    $resultado = @mysqli_query($conexao, "INSERT INTO usuario VALUES('$cpf', '$nome', '$senha')");

    if (!$resultado) {
        die('Query inválida: ' . @mysqli_error($conexao));
    } else {
        header('Location: login.php');
    }

    mysqli_close($conexao);
?>