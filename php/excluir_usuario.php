<?php
    include_once("conexao.php");

    $cpf = $_GET['usuario'];

    $consultaExcluir = @mysqli_query($conexao, "SELECT * FROM usuario WHERE CPF = '$cpf'");

    if (!$consultaExcluir) {
        die('Query inválida: ' . @mysqli_error($conexao));
    } else {
        $num = @mysqli_num_rows($consultaExcluir);
        if ($num == 0) {
            echo"Não localizado";
            echo"Retornar ao index: " . '<a href="index.php?txtpesquisar=">Retornar</a>';
            exit;
        } else {
            $dadosUsuario = mysqli_fetch_array($consultaExcluir);
        }
    }


?>


    <div class="container" style="text-align: center;">
        <h1>Exclusão de usuário</h1>

        <form action="excluir_usuarioCon.php" method="post" class="row card card-body" style="margin: 50px; text-align: left;">
            <div class="row">
                <div class="col-md-4" style="padding: 20px;">
                    <label>CPF</label>
                    <input type="text" name="txtcpf" class="form-control" value='<?php echo $dadosUsuario['CPF']; ?>' readonly>
                </div>
                <div class="col-md-8" style="padding: 20px;">
                    <label>Nome</label>
                    <input type="text" name="txtnome" class="form-control" value='<?php echo $dadosUsuario['NOME']; ?>' readonly>
                </div>
                <div class="col-md-4" style="padding: 20px;">
                    <label>Senha</label>
                    <input type="text" name="txtsenha" class="form-control" value='<?php echo $dadosUsuario['SENHA']; ?>' readonly>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </div>
        </form>
</div>