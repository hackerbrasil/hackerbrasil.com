<div class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="/" title="Hacker Brasil">
                <img src="/img/flags/br.svg" alt="Hacker Brasil" class="logo">
                Hacker Brasil</a>
                <div class="nav-collapse collapse">
                    <div class="navbar-text pull-right">
                        <ul class="nav">
                            <li><a id="carregando"></a></li>
                            <li><a target="_blank" href="https://twitter.com/hackerint">Twitter</a></li>
                        </ul>
                    </div>
                    <ul class="nav" id="navOnline">
                        <!-- <li><a href="/top10/links">Top 10 links</a></li> -->
                        <li><a href="/top10/sites">Top 10 sites</a></li>
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
