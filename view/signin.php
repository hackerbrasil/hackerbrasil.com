<!DOCTYPE html>
<html lang="pt" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Entrar</title>
    <?php view('inc/assets'); ?>
    <style type="text/css">
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin input[type="text"],
    .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
    }

    </style>
</head>
<body>
    <div class="container-flud">
        <form class="form-signin" method="post" action="/signin">
            <h2 class="form-signin-heading">Entrar</h2>
            <?php
            if(isset($error)){
                ?>
                <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Dados incorretos</strong>
                </div>
                <?php
            }
            ?>
            <input type="text" class="input-block-level" placeholder="Email" name="email">
            <input type="password" class="input-block-level" placeholder="Senha" name="password">
            <button class="btn btn-large btn-primary btn-block" type="submit">Entrar</button>
        </form>
    </div>
    <?php view("inc/footer"); ?>
</body>
</html>
