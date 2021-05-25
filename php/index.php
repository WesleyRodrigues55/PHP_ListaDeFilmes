<?php
//conexao com banco
include("conexao.php");

include("loginLogica.php");
verificaUsuario();

//-------------------------------------------------------------------
//código barra de pesquisa
$pesquisa = $_GET['txtpesquisar'];
if ($pesquisa != "") {
    $consultaP = "SELECT * FROM produto WHERE nome like '%$pesquisa%'";
} else {
    $consultaP = "SELECT * FROM produto";
}
$con = @mysqli_query($conexao, $consultaP) or die($mysqli->error);

//--------------------------------------------------------------------
//amarração da tabela venda com a tabela finalizar_venda, pegando o último registro do id (comando max)
$consulta = "SELECT max(ID) as ID FROM venda_produto";
$conn = @mysqli_query($conexao, $consulta) or die($mysqli->error);
$dadosUsuario1 = mysqli_fetch_array($conn);

//-------------------------------------------------------------------
// recebe os dados do usuario logado
$RecebeUsuario = $dadosUsuario1['ID'];
// selecionado o usuario logado
$nomeUsuario = "SELECT venda_produto.CPF_USUARIO, usuario.NOME FROM
 venda_produto, usuario WHERE venda_produto.ID = $RecebeUsuario AND venda_produto.CPF_USUARIO = usuario.CPF";
//consulta a conexao com o banco
$usuarioConsulta = @mysqli_query($conexao,$nomeUsuario) or die($mysqli -> error);
//seleciona entre os (usuários) apenas o logado 
$dadosUsuario = mysqli_fetch_array($usuarioConsulta);

//-------------------------------------------------------------------
?>
<!-- fim php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
    <!-- css -->
    <!-- <link rel="stylesheet" href="estilo.css"> -->
    <!-- bootstrap -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<style>
    /* navegacao */

    * {
    padding: 0;
    margin: 0;
    }

    

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        background-image: url("../img/bgbody.png");
        background-attachment: fixed;
    }


    /* nav */

    .user {
        background: linear-gradient(RGBA(32, 61, 102, 0.9), RGBA(32, 61, 102, 0.9), RGBA(32, 61, 102, 0.9));
        border: none;
        padding: 20px 100px;
    }

    .navigation {
        border: none;
        background: linear-gradient(RGBA(32, 61, 102, 0.9), RGBA(32, 61, 102, 0.8), RGBA(32, 61, 102, 0.7));

        padding: 20px 100px;
    }

    .navigation>h1 {
        font-size: 50px;
        color: white;
    }

    ul>li {
        margin: 5px 10px;
        list-style: none;
        color: white;
        font-size: 18px;
        font-weight: bold;
    }

    .nave {
        color: white;
        font-size: 18px;
        font-weight: bold;
    }

    .nave:hover {
        color: #1497ad;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
    }

    .barra {
        border-left: 3px solid white;
        height: 30px;
    }

    /* header */


    .content-header {
        margin-top: 20px;
        overflow-x: hidden;
        padding: 30px;
        background: rgba(0, 0, 0, 0.9);
    }

    .content-header .content-title {
        text-align: center;
        border: 1px solid black;
    }

    .content-header .content-slide {
        border: 1px solid black;
    }

    .content-header .button-down {
        border: 1px solid black;
        text-align: center;
    }

    .wellcome {
        color: white;
        font-size: 50px;
        font-weight: bold;
        text-shadow: 3px 3px RGB(32, 61, 102);
    }

    /* botoes e hover */
    .botao-sair {
        background-color: #a4a614;
        font-weight: bold;
        color: white;
    }

    .botao-sair:hover {
        background-color: #bdbf19;
        font-weight: bold;
        color: white;
    }

    .botao-alterar-excluir-carrinho {
        background-color: #0f8194;
        font-weight: bold;
        color: white;
    }

    .botao-alterar-excluir-carrinho:hover {
        background-color: #1497ad;
        font-weight: bold;
        color: white;
    }

    .botao-finalizar-venda-adiconar {
        background: #14ab32;
        color: white; 
        font-weight: bold;
    }

    .botao-finalizar-venda-adiconar:hover {
        background: #1bcf3f;
        color: white; 
        font-weight: bold;
    }

    .botao-acoes {
        background-color: #0f8194;
        color: white;
    }

    .botao-acoes:hover {
        background-color: #1497ad;
        color: white;
    }


    /* div array */
    .content {
        border: 1px solid rgba(0, 0, 0, 0.02);
        padding: 10px;
        margin: 5px 0px;
        box-shadow: 0 2px 5px 0 black;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .sinopse {
        color: white;
    }
    .codigo-p {
        color: #333;
        text-align: center;
        padding: 10px 0;
    }

    .title {
        color: white;
        font-size: 20px;
    }

    .preco {
        color: green;
    }

</style>
</head>

<body>

        <!-- navegação do site -->
        <div class="container-fluid d-flex align-items-center justify-content-center user">
            <!-- recebendo dados do logiun do usuario -->
            <p style="color: white; font-size: 25px; margin: 0 20px"><?php echo "Bem vindo, " . $dadosUsuario['NOME']; ?></p>
            <!-- botões de ações do usuário -->

            <!-- botão logout -->
            <a href="loginLogout.php"><button class="btn botao-sair" style="margin: 0 20px">
                <svg xmlns="http://www.w3.org/2000/svg" style="color: white" width="19" height="19" style="margin: 0 5px;" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
                </svg>Logout</button>
            </a>

            <!-- botão alterar usuário -->
            <button class="btn botao-alterar-excluir-carrinho" data-toggle="modal" data-target="#idmodalAlterar<?php echo $dadosUsuario['CPF_USUARIO'] ?>" style="margin: 0 20px">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" style="margin: 0 5px;" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>Alterar usuário
            </button>
            <!-- MODAL DE ALTERAR DE USUÁRIO-->
            <div class="modal fade" id="idmodalAlterar<?php echo $dadosUsuario['CPF_USUARIO'] ?>" tabindex="-1" role="dialog"   aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" id="modal-color">
                        <!-- Aqui chama o título do modal -->
                        <div class="modal-header" style="padding: 30px">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                                <h1>Alteração de usuário</h1>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Aqui chama o Body dele (conteúdo) -->
                        <div class="modal-body" style="padding: 30px">
                            <?php
                                include_once("conexao.php");

                                $cpfAlterar = $dadosUsuario['CPF_USUARIO'];

                                $consultaAlterar = @mysqli_query($conexao, "SELECT * FROM usuario WHERE CPF = '$cpfAlterar'");

                                if (!$consultaAlterar) {
                                    die('Query inválida: ' . @mysqli_error($conexao));
                                } else {
                                    $num = @mysqli_num_rows($consultaAlterar);
                                    if ($num == 0) {
                                    echo"Não localizado";
                                    echo"Retornar ao index: " . '<a href="index.php?txtpesquisar=">Retornar</a>';
                                    exit;
                                    } else {
                                        $dadosUsuario = mysqli_fetch_array($consultaAlterar);
                                    }
                                }
                            ?>

                            <div style="text-align: center;">
                                <h1>Alteração de usuário</h1>

                                <form action="alterar_usuarioCon.php" method="post" class="row" style="text-align: left;">
                                    <div class="row">
                                        <div class="col-md-4" style="padding: 5px 15px;">
                                            <label>CPF</label>
                                            <input type="text" name="txtcpf" class="form-control" value='<?php echo $dadosUsuario['CPF']; ?>' readonly>
                                        </div>
                                        <div class="col-md-12" style="padding: 5px 15px;">
                                            <label>Nome</label>
                                            <input type="text" name="txtnome" class="form-control" value='<?php echo $dadosUsuario['NOME']; ?>'>
                                        </div>
                                        <div class="col-md-6" style="padding: 5px 15px;">
                                            <label>Senha</label>
                                            <input type="password" name="txtsenha" class="form-control" value='<?php echo $dadosUsuario['SENHA']; ?>'>
                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-info">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Aqui chama o rodapé, usados para botões, exemplo btnsair -->
                        <div class="modal-footer">
                            <button style="color: black" type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fim modal -->
        </div>
    </div>
        <nav class="navbar navbar-expand-lg sticky-top navigation">
            <h1 class="navbar-brand p2">LOGO</h1>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" style="color: white" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="ml-auto p-2 d-flex justify-content-between">
                    <li class="nave">Home</li>
                    <li class="barra"></li>
                    <li class="nave">Filmes</li>
                    <li class="barra"></li>
                    <li class="nave">Contact</li>
                </ul>
            </div>
        </nav>


    <!-- header (home) -->
    <header class="content-header container">
        <div class="row d-flex align-items-center">
            <div class="col-md-6" style="text-align: center;">
                <h1 class="wellcome">BEM VINDO AO CINE</h1>
            </div>
            <div class="col-md-6">
                <!-- array carrossel -->
                <?php
                    $consultaCarrossel = @mysqli_query($conexao, "SELECT IMAGEM FROM produto");
                    /* Por cada resultado, preparar a saída*/
                    $imagesHtml = '';
                    $indicatorDotsHtml = '';
                    $i = 0;
                    while($row = mysqli_fetch_array($consultaCarrossel)) {
                        $filename = $row['IMAGEM'];
                        // classe "active" apenas no primeiro elemento
                        $active = $i==0 ? 'active' : '';
                        // criar HTML para a imagem
                        $imagesHtml.= '
                        <div class="carousel-item '.$active.' carrossel" style="text-align: center">
                            <img src="../img/'.$filename.'" alt="'.$filename.'" style="margin: 5px; box-shadow: 0px 10px 10px 10px white"/>
                        </div>';
                        // criar HTML para o indicador da imagem
                        $indicatorDotsHtml.= '
                        <li data-target="#myCarousel" data-slide-to="'.$i.'" class="'.$active.'"></li>';
                        $i++;
                    }
                    /* Preparar a saída para o navegador*/
                    if (!empty($imagesHtml)) {
                        /* Verificar se precisamos de navegação*/
                        $navHtml = '';
                        if ($i>1) {
                            $indicatorsHtml = '
                            <ol class="carousel-indicators">
                                
                            </ol>';
                            // .$indicatorDotsHtml. usado em cima
                            $navHtml = '
                            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>';
                        }
                        /* Enviar saída para o navegador*/
                        echo '
                        <div data-interval="2000" id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            '.$indicatorsHtml.'
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                '.$imagesHtml.'
                            </div>
                            
                        </div>';
                    }
                ?> 
            </div>
        </div>
        
    </header>

    <!-- conteudo -->
    <section class="container">
        <div class="d-flex justify-content-between" style="padding: 20px;">
            <div class="">
                <!-- botão que chama o modal carrinho-->
                <button class="btn botao-alterar-excluir-carrinho" data-toggle="modal" data-target="#idmodal<?php echo $RecebeUsuario?>" title="Carrinho de compras">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="margin-right: 5px" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                    </svg>Carrinho
                </button>

                <!-- COMEÇO MODAL CARRINHO -->
                <div class="modal fade" id="idmodal<?php echo $RecebeUsuario?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" id="modal-color">
                            <!-- nav do modal -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">título</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                            
                            <!-- body do modal -->
                            <div class="modal-body">
                                <?php 
                                    echo $RecebeUsuario; 
                                        
                                    //verificação para mostra descricao do produto
                                    $ProdConsulta = "SELECT produto.ID, produto.NOME, finalizar_venda.ID_VENDA, finalizar_venda.ID_PRODUTO, finalizar_venda.PRECO, finalizar_venda.QUANTIDADE FROM produto, finalizar_venda WHERE finalizar_venda.ID_VENDA = $RecebeUsuario and finalizar_venda.ID_PRODUTO = produto.ID";  
                                    $conect = @mysqli_query($conexao,$ProdConsulta) or die($mysqli -> error); 
                    
                                    //fazendo select para exibição do total da venda
                                    $preco = "SELECT sum(PRECO * QUANTIDADE) as TOTAL FROM finalizar_venda where ID_VENDA = $RecebeUsuario";  
                    
                                    $con_preco = @mysqli_query($conexao,$preco) or die($mysqli -> error); 
                                    $total = mysqli_fetch_array($con_preco);
                                                
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Total da Venda</label><br>
                                        <input type="number" name="txttotal" maxlength='20' style="width:80px" value='<?php echo number_format($total['TOTAL'],2); ?>'readonly>
                                        <table id="grid_cadastro" class="table">
                                            <thead class="thead-dark">      
                                                <tr> 
                                                    <td>Produto</td> 
                                                    <td>Preço</td>           
                                                    <td>Qtd</td>          
                                                    <td>Total</td>
                                                </tr> 
                                            </thead>
                    
                                            <?php while($dados = $conect->fetch_array()) { ?> 
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
                            </div>
                            <!-- fim body modal -->
                                            
                            <!-- footer do modal -->
                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit">Finalizar venda</button>
                                <button style="color: black" type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fim modal carrinho-->

                <!-- botão que finaliza venda -->
                <button class="btn botao-finalizar-venda-adiconar" type="submit" onclick="retorna()" title="Finalizar venda">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="margin-right: 5px" fill="currentColor" class="bi bi-piggy-bank" viewBox="0 0 16 16">
                    <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0zm1.138-1.496A6.613 6.613 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.602 7.602 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962z"/>
                    <path fill-rule="evenodd" d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069c0-.145-.007-.29-.02-.431.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a.95.95 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.735.735 0 0 0-.375.562c-.024.243.082.48.32.654a2.112 2.112 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595zM2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.558 6.558 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.649 4.649 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393zm12.621-.857a.565.565 0 0 1-.098.21.704.704 0 0 1-.044-.025c-.146-.09-.157-.175-.152-.223a.236.236 0 0 1 .117-.173c.049-.027.08-.021.113.012a.202.202 0 0 1 .064.199z"/>
                    </svg>Finalizar venda
                </button>
                <!-- script para finalizar ou não a venda -->
                <script>
                    function retorna(retornaIndex) {
                        var confirma = window.confirm("Deseja finalizar sua venda? ");
                        if (confirma == true) {
                            window.location.href = 'login.php';
                        } else {
                            return false;
                        }
                    }
                </script>
            </div>

            <div class="">
                <!-- caixa de pesquisa -->
                <form action="index.php" method="get" class="d-flex">
                    <input type="text" class="form-control" name="txtpesquisar" placeholder="pesquisa por nome" id="pesquisa">
                    <button type="submit" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="color: white;" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg></button>
                </form>
            </div>

            <div class="">
                <!-- botão que cadastra um novo produto -->
                <a href="cad_produtos.php">
                    <button class="btn botao-acoes" title="Cadastrar um novo produto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"/>
                    </svg></button>
                </a>
                <!-- botão que excluir um produto -->
                <a href="#">
                    <button class="btn botao-acoes" title="Excluir um produto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg></button>
                </a>
                <!-- botão que altera um produto -->
                <a href="#.php">
                    <button class="btn botao-acoes" title="Alterar um produto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                    </svg></button>
                </a>
            </div>
        </div>
        <!-- fim d-flex menu de ações -->

        <!-- lista de produtos -->
        <div class="row">
            <!-- array par arepetir os produtos -->
            <?php while($dadosUsuario = $con->fetch_array()) {?>
                <div class="col-md-4">
                    <div class="content">
                        <div class="row">
                                <!-- chamando dados para array -->
                                <div class="col-12">
                                <h1 class="title"><?php echo $dadosUsuario['NOME']; ?></h1>
                                </div>
                                <div class="col-md-6" style="text-align: center">
                                    <img src="../img/<?php echo $dadosUsuario['IMAGEM']; ?>" style="width: 150px;">
                                    <p class="codigo-p">Código do produto: <?php echo $dadosUsuario['ID']; ?></p>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <!-- chamando dados para array -->
                                        <div class="col-md-12">
                                            <p class="sinopse"><?php echo $dadosUsuario['SINOPSE']; ?></p>
                                            <h3 class="preco"><?php echo "R$ " . $dadosUsuario['PRECO']; ?></h3>
                                        </div>
                                        <!-- chamando dados para array -->
                                        <div class="col-md-12">
                                            <!-- botão de adiconar produto -->
                                            <a href="cad_carrinho.php?codigo=<?php echo $dadosUsuario['ID'];?>&id_venda=<?php echo $RecebeUsuario;?>&preco=<?php echo $dadosUsuario['PRECO'];?>&qntd=1">
                                                <button type="submit" class="btn botao-finalizar-venda-adiconar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="margin-right: 5px" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>Adiconar</button>  
                                            </a>
                                        </div>
                                    </div>
                                    <!-- fim row -->
                                </div>
                            <!-- fim row -->
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- fim section -->

    <!-- para animação do menu -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>