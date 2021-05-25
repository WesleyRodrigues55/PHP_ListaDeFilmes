<?php
include("conexao.php");

//pega valor do get e armazena
$id_venda = $_GET['id_venda'];

// selecionado o cliente
$nome_cli = "SELECT venda_produto.CPF_USUARIO, usuario.NOME from venda_produto, usuario WHERE venda_produto.ID = $id_venda and venda_produto.CPF_USUARIO = usuario.CPF";

$usuario = @mysqli_query($conexao,$nome_cli) or die($mysqli -> error); 
$dado_usuario = mysqli_fetch_array($usuario);

//verificação para mostra descricao do produto
$consulta = "SELECT produto.ID, produto.NOME, finalizar_venda.ID_VENDA, finalizar_venda.ID_PRODUTO, finalizar_venda.PRECO, finalizar_venda.QUANTIDADE FROM produto, finalizar_venda WHERE finalizar_venda.ID_VENDA = $id_venda and finalizar_venda.ID_PRODUTO = produto.ID";  
$conn = @mysqli_query($conexao,$consulta) or die($mysqli -> error); 

//fazendo select para exibição do total da venda
$preco = "SELECT sum(PRECO * QUANTIDADE) as TOTAL FROM finalizar_venda where ID_VENDA = $id_venda";  

$con_preco = @mysqli_query($conexao,$preco) or die($mysqli -> error); 
$total = mysqli_fetch_array($con_preco);
?>

<!DOCTYPE html> 
    <html> 
        <head> 
        <title>Consulta vendas</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- JS para animações -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

        </head> 

        <body> 

            <div class="row">
                <div class="col-md-12">
                    <table id="grid_cadastro" class="table">
                        <div class="box">
                            <label>Código</label><br>
                            <input type="text" name="txtcodigo" value='<?php echo $dado_usuario['CPF_USUARIO']; ?>' readonly>
                            <br><br>
                            <label>Nome Cliente</label><br>
                            <input type="text" name="txtdesc" maxlength='80' style="width:550px" value='<?php echo $dado_usuario['NOME']; ?>'readonly>
                            <br><br>
                            <label>Total da Venda</label><br>
                            <input type="number" name="txttotal" maxlength='20' style="width:80px" value='<?php echo number_format($total['TOTAL'],2); ?>'readonly>
                            <br><br>
                        </div>

                        <thead class="thead-dark">      

                            <tr> 
                                <td>Produto</td> 
                                <td>Preço</td>           
                                <td>Qtd</td>          
                                <td>Total</td>
                            </tr> 

                        </thead>

                        <?php while($dados = $con->fetch_array()) { ?> 

                            <tr> 
                                <td><?php echo $dados['NOME']; ?></td> 
                                <td><?php echo $dados['PRECO']; ?></td>           
                                <td><?php echo $dados['QUANTIDADE']; ?></td>            
                                <td><?php echo number_format($dados['PRECO'] * $dados['QUANTIDADE'],2); ?></td>           
                                <td></td> 
                            </tr> 

                        <?php } ?> 

                    </table> 
                </div>
            </div>
        </body> 
    </html>