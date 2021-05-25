<?php

// Estabelecer ligação à base de dados
include("conexao.php");

// Recolher resultados
$consulta = @mysqli_query($conexao, "SELECT IMAGEM FROM produto");
?>

<html>
    <head>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    </head>
<body>



<?php
/* Por cada resultado, preparar a saída*/
$imagesHtml = '';
$indicatorDotsHtml = '';
$i = 0;
while($row = mysqli_fetch_array($consulta)) {
    $filename = $row['IMAGEM'];
    // classe "active" apenas no primeiro elemento
    $active = $i==0 ? 'active' : '';
    // criar HTML para a imagem
    $imagesHtml.= '
    <div class="carousel-item '.$active.'" style="text-align: center">
        <img src="../img/'.$filename.'" alt="'.$filename.'" />
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
            '.$indicatorDotsHtml.'
        </ol>';
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
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        '.$indicatorsHtml.'
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            '.$imagesHtml.'
        </div>
        <!-- Left and right controls -->
        '.$navHtml.'
    </div>';
}
?> 

</body><!-- para animação do menu -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>