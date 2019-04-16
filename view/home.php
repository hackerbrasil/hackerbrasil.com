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
                    O <b>HackerBrasil.com</b> agora é <b>HackerInt.com</b>.
                    Outras novidades virão em breve, aguardem.
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
</body>
</html>
