<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Painel de Controle</title>
    <?php view('inc/assets'); ?>
    <style>
    body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
    }
    </style>
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="/">Hacker Brasil</a>
                <div class="nav-collapse collapse">
                    <div class="navbar-text pull-right">
                        <i class="icon-white icon-user"></i>
                        Logado como <b><?php print $user['name']; ?></b>&nbsp;
                        <ul class="nav pull-right">
                            <li>
                                <a href="/logout">
                                    <i class="icon-white icon-remove"></i> Sair
                                </a>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav">
                        <li class="active"><a href="/dashboard">Painel de controle</a></li>
                        <li><a href="/dashboard/feeds">Feeds</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>

    <div class="container">

        <h1>Bootstrap starter template</h1>
        <p>Use this document as a way to quick start any new project.<br> All you get is this message and a barebones HTML document.</p>

    </div> <!-- /container -->
    <?php view("inc/footer"); ?>
</body>
</html>
