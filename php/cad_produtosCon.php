<?php
    include("conexao.php");

    $nome = $_POST['txtnome'];
    $preco = $_POST['txtpreco'];
    // $qnt = $_POST['txtqtd'];
    $imagem = $_POST['txtimagem'];
    $obs = $_POST['txtobs'];

    // $sqliinsert = "INSERT INTO produto VALUES(0, '$produto', '$imagem', '$preco', '$obs')";

    $consulta = @mysqli_query($conexao, "INSERT INTO produto VALUES(0, '$nome', '$preco', 0, '$obs', '$imagem')");

    if (!$consulta) {
        die('Query inválida' . @mysqli_error($conexao));
    } else {
        echo "<br><br><br><h1>Produto cadastrado com sucesso</h1><br><a href='index.php?txtpesquisar='>voltar</a>
            <h1>Ou</h1>
            <a href='cad_produtos.php'>Cadastrar outro produto</a>";
    }

    mysqli_close($conexao);
            
?>