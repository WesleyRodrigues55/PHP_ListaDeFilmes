<?php
    //inicia a sessão
    session_start();

    //caso esteja logado
    function EstaLogado() {
        return isset($_SESSION["usuario_logado"]);
    }

    //verifica o usuário
    function verificaUsuario() {
        if (!EstaLogado()) {
            header('Location: loginErro.php');
            die();
        }
    }

    function usuarioLogado() {
        return $_SESSION["usuario_logado"];
    }

    //quando o usuário loga
    function Logado($cpf) {
        $_SESSION["usuario_logado"] = $cpf;
        return $_SESSION["usuario_logado"];
    }

    //quando faz logout
    function logout() {
        //destrói a sessão
        session_destroy();
    }
?>