<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Painel de Controle</title>
    <?php view('inc/assets'); ?>
    <style>
    body {
        padding-top: 60px;
    }
    </style>
</head>
<body>
    <?php view('inc/navOnline',$data); ?>
    <div class="container">
        <p>Espaço para graficos</p>
    </div> <!-- /container -->
    <?php view("inc/footer"); ?>
</body>
</html>
