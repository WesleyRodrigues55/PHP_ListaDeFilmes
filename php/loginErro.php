<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sem permissão</title>

    <!-- retorna a page anterior com refresh e tempo em (s) -->
    <!-- <equiv="refresh" content=0; url="usuarioLOGIN.php"> -->
    <script>
        function alerta() {
            alert('Sem permissão!');
            window.location.href = 'login.php';
        }
    </script>
</head>
<body onload="alerta()">
    
</body>
</html>