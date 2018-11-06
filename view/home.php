<!DOCTYPE html>
<html lang="pt" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacker Gaucho</title>

    <link rel="stylesheet" href="/css/bootstrap-2.3.2.min.css" integrity="sha256-GGxA0G/BODBJenufQrwUU4wbf6C5hWDHkR5uGpNfdp0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="/bootstrap-responsive-2.3.2.min.css" integrity="sha256-lIFJvX0EbEpgbhha1orNrXaV1TKngfVWrIbwgcHl80E=" crossorigin="anonymous" />
    <link rel="stylesheet" href="/style.css">

</head>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <h1>Hacker Brasil<br><small id="carregando"></small></h1>
                <input type="text" class="input-block-level" id="q" placeholder="Buscar...">
                <ul class="nav nav-tabs nav-stacked" id="links">
                </ul>
                <div id="pacman">
                    <img src="/pacman.gif" alt="Pacman">
                </div>
            </div>
        </div>
    </div>
    <script src="/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="/jquery.appear.js"></script>
    <script src="/jquery.scrolling.js"></script>
    <script src="/script.js"></script>
    <!-- Matomo -->
    <script type="text/javascript">
    var _paq = _paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="https://piwik.mushape.com/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<!-- End Matomo Code -->
</body>
</html>
