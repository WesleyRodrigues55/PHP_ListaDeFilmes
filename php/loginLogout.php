<?php
    //incluindo
    include("loginLogica.php");

    //usando função logout
    logout();

    //retornando para página de login
    header('Location: login.php');
?>
