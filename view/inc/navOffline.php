<div class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="/">Hacker Brasil</a>
            <div class="nav-collapse collapse">
                <div class="navbar-text pull-right" id="carregando">

                </div>
                <ul class="nav" id="navOnline">

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
