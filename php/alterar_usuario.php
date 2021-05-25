<?php
    include_once("conexao.php");
    //verifica se foi logado ou não
    verificaUsuario();

    $cpf = $_GET['usuario'];

    $consulta = @mysqli_query($conexao, "SELECT * FROM usuario WHERE CPF = '$cpf'");

    if (!$consulta) {
        die('Query inválida: ' . @mysqli_error($conexao));
    } else {
        $num = @mysqli_num_rows($consulta);
        if ($num == 0) {
            echo"Não localizado";
            echo"Retornar ao index: " . '<a href="index.php?txtpesquisar=">Retornar</a>';
            exit;
        } else {
            $dadosUsuario = mysqli_fetch_array($consulta);
        }
    }

    mysqli_close($conexao);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>

    <section class="container" style="text-align: center;">
        <h1>Alteração de usuário</h1>

        <form action="alterar_usuarioCon.php" method="post" class="row card card-body" style="margin: 50px; text-align: left;">
            <div class="row">
                <div class="col-md-4" style="padding: 20px;">
                    <label>CPF</label>
                    <input type="text" name="txtcpf" class="form-control" value='<?php echo $dadosUsuario['CPF']; ?>' readonly>
                </div>
                <div class="col-md-8" style="padding: 20px;">
                    <label>Nome</label>
                    <input type="text" name="txtnome" class="form-control" value='<?php echo $dadosUsuario['NOME']; ?>'>
                </div>
                <div class="col-md-4" style="padding: 20px;">
                    <label>Senha</label>
                    <input type="text" name="txtsenha" class="form-control" value='<?php echo $dadosUsuario['SENHA']; ?>'>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-info">Salvar</button>
                </div>
            </div>
        </form>
    </section>

</body>

</html>