<?php
    //conexao com banco
    include("conexao.php");
    //sessões para login ->
    include("loginBanco.php");
    include("loginLogica.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        html,
        body,
        .form-header {
            height: 100%;
            overflow-y: hidden;
            /* overflow-y: auto; */
        }
        
        .form-header {
            display: table;
            width: 100%;
        }
        
        .form-content {
            /* text-align: center; */
            display: table-cell;
            vertical-align: middle;
        }
        
        .form {
            border: 1px solid black;
            margin: auto;
            width: 500px;
            height: 400px;
            padding: 30px;
        }
        
        .footer-form {
            text-align: center;
            margin: 20px;
        }
    </style>
</head>

<body>
    <header class="container-fluid form-header">
        <div class="form-content">
            <div class="form">
                <h1>Faça login e comece a comprar agora</h1>
                <form class="form-group" method="post">
                    <label>Nome</label>
                    <input type="text" class="form-control" placeholder="digite seu nome" name="txtnome" id="txtnome" title="Digite seu nome">

                    <label>CPF</label>
                    <input type="number" class="form-control" placeholder="000.000.000-00" name="txtcpf" id="txtcpf" title="Digite seu CPF">
                    <div class="footer-form ">
                        <button type="submit" class="btn btn-primary" title="Clique aqui para continuar">Entrar</button>
                        <br>
                        <label>Não tem uma conta?</label>
                        <a href="#" data-toggle="modal" data-target="#idmodalCadastrar" title="Clique aqui e cadastre-se">Clique aqui e cadastre-se</a>
                    </div>
                    <?php
                        if ($_POST) {
                            $cpf = $_POST['txtcpf'];
                            $nome = $_POST['txtnome'];

                            if (efetuaLogin($conexao, $cpf, $nome)) {                               
                                //passa parâmetros para outra função
                                Logado($cpf);

                                header('Location: index.php?txtpesquisar=');
                                
                                //faz o insert na tebela venda_produto
                                if (efetuaInsert($conexao, $cpf, $nome)) {
                                    $usuarioLogado1($cpf, $nome);
                                }
                            } else {
                                $cpf = $_POST['txtcpf'];
                                echo '<div style="text-align:center; color: white; background: #F88E7F; padding: 20px; border-radius: 100px">' . 
                                '<h4>' . "usuário ou CPF incorretos!" . '</h4>'. 
                                '</div>';
                            }
                        }
                    ?>
                </form>
            </div>
    </header>

    <!-- MODAL DE CADASTRO DE USUÁRIO-->
    <div class="modal fade" id="idmodalCadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="modal-color">
                <!-- Aqui chama o título do modal -->
                <div class="modal-header" style="padding: 30px">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <h1>Cadastro de usuário</h1>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <!-- Aqui chama o Body dele (conteúdo) -->
                <div class="modal-body" style="padding: 30px">
                    <form class="" action="cad_usuario.php" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="txtnome" placeholder="Digite seu nome" title="Digite seu nome">
                        </div>
                        <div class="form-group">
                            <label>CPF</label>
                            <input type="number" class="form-control" name="txtcpf" placeholder="000.000.000-00" title="Digite seuCPF">
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" class="form-control" name="txtsenha" placeholder="Digite sua senha" title="Digite sua senha">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
                <!-- Aqui chama o rodapé, usados para botões, exemplo btnsair -->
                <div class="modal-footer">
                    <button style="color: black" type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fim modal -->


    <!-- para animação do menu -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>