<!DOCTYPE html>
<html lang="pt" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php print $title; ?></title>
    <?php view('inc/assets'); ?>
</head>
<body>
    <?php view('inc/navOffline'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="alert alert-info alert-block">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    O <b>HackerBrasil.com</b> agora é <b>HackerInt.com</b>. O domínio hackerbrasil.com deixará de funcionar dia 30 de abril de 2019. Outras <a target="_blank" href="https://aicouto.com/hacker-int-a-nova-versao-do-hacker-brasil/">novidades</a> virão em breve, aguardem.
                </div>
                <h1><small id="carregando"></small></h1>
                <label for="s"><small>Buscar pelo título</small></label>
                <input type="text" class="input-block-level" id="s" placeholder="Buscar...">
                <ul class="nav nav-tabs nav-stacked listaDeLinks" id="links">
                </ul>
                <div id="gatilho" class="text-center">
                    <img src="/img/flags/br.svg" alt="Brasil" width="75">
                </div>
            </div>
        </div>
    </div>
    <?php view("inc/footer"); ?>
    <script type="text/javascript">
    $(function() {//gatilhos
        $('#s').val('').focus();
        baixarLinks(nextId);

        $("#s").on("change paste keyup",function() {

            var input = $(this);
            var val = input.val();

            if (input.data("lastval") != val) {
                input.data("lastval", val);
                if(val.length>=1){
                    buscarLinks($(this).val());
                }
            }


        });
    });
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(53403718, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/53403718" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
