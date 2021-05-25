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
        <h1>Cadastro de produtos</h1>

        <form action="cad_produtosCon.php" method="post" class="row card card-body" style="margin: 50px; text-align: left;">
            <div class="row">
                <div class="col-md-12" style="padding: 20px;">
                    <label>Nome do produto</label>
                    <input type="text" name="txtnome" class="form-control" placeholder="digite o nome do produto">
                </div>

                <div class="col-md-6" style="padding: 20px;">
                    <div class="row">
                        <div class="col-md-12" style="padding: 20px;">
                            <!-- <label>Selecione uma imagem</label> -->
                            <input type="file" name="txtimagem">
                        </div>
                        <div class="col-md-12" style="padding: 20px;">
                            <label>Preço</label>
                            <input type="text" name="txtpreco" class="form-control" placeholder="digite o preço do produto">
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="padding: 20px;">
                    <label>Sinopse</label>
                    <textarea name="txtobs" class="form-control" rows="6"></textarea>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-info">Salvar</button>
                </div>
            </div>
        </form>
    </section>

</body>

</html>