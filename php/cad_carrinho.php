<?php
    include("conexao.php");

    $codigo = $_GET['codigo'];
    $id_venda = $_GET['id_venda'];
    $preco = $_GET['preco'];
    $quantidade = $_GET['qntd'];

    $sqliinsert = "INSERT INTO finalizar_venda 
    VALUES(0, '$codigo', '$id_venda', '$preco', '$quantidade')";

    $consulta = @mysqli_query($conexao, $sqliinsert);

    if (!$consulta) {
        die('Query inválida: ' . @mysqli_error($conexao));
    } else {
        header('Location: index.php?txtpesquisar=');
    }

    mysqli_close($conexao);
?>