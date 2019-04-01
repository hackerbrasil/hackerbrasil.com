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

                    <ul class="nav  pull-right">
                        <li><a id="carregando"></a></li>
                        <li><a target="_blank" href="https://twitter.com/aicouto">Twitter</a></li>
                        <li>
                            <?php
                            if(isset($_GET['night'])){
                                $href='/';
                                $text='Dark mode <span class="label label-important">ON</span>';
                            }else{
                                $href='/?night';
                                $text='Dark mode <span class="label label-inverse">OFF</span>';
                            }
                            print '<a href="'.$href.'">'.$text.'</a>';
                            ?>
                        </li>
                    </ul>
                    <ul class="nav" id="navOnline">

                        <!-- <li><a href="/top10/links">Top 10 links</a></li> -->
                        <li><a href="/top10/sites">Top 10 sites</a></li>
                        <!-- <li><a href="https://aicoutodasilva.github.io/10_mil_links_no_hacker_brasil.html" target="_blank">Sobre</a></li> -->
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
