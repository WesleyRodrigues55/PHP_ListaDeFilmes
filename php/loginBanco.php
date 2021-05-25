<?php

    //função feita para efetuar o login
    function efetuaLogin($conexao, $cpf, $nome) {
        //consulta no banco
        $consulta = @mysqli_query($conexao, "SELECT * FROM usuario WHERE CPF = '$cpf' AND NOME = '$nome'");

        //verifica se existe algo no banco
        $usuarioLogado = mysqli_fetch_assoc($consulta);

        //retorna a verificação
        return $usuarioLogado;
    }

    //faz insert na tebala de venda_produto
    function efetuaInsert($conexao, $cpf, $nome) {
        //consulta no banco
        $consulta1 = @mysqli_query($conexao, "INSERT INTO venda_produto VALUES(0, now(), '$cpf', '$nome')");

        //verifica se existe algo no banco
        $usuarioLogado1 = mysqli_fetch_assoc($consulta1);

        //retorna a verificação
        return $usuarioLogado1;
    }
?>