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
                <ul class="nav" id="navOnline">
                    <li><a href="/dashboard">Painel de controle</a></li>
                    <li><a href="/dashboard/feeds">Feeds</a></li>
                    <li><a href="/dashboard/users">Usuários</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
<script type="text/javascript">
$("#navOnline li a").each(function(index) {
    if($.trim(this.href) == window.location) {
        $(this).closest('li').addClass("active");
    }
});
</script>
