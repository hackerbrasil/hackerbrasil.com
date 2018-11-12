<!DOCTYPE html>
<html lang="pt" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacker Gaucho</title>
    <?php view('inc/assets'); ?>

</head>
<body>
    <?php view('inc/navOffline'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <h1><small id="carregando"></small></h1>
                <label for="s"><small>Buscar pelo título</small></label>
                <input type="text" class="input-block-level" id="s" placeholder="Buscar...">
                <ul class="nav nav-tabs nav-stacked" id="links">
                </ul>
                <div id="gatilho" class="text-center">
                    <img src="/img/brasil.gif" alt="Brasil" width="75" height="49">
                </div>
            </div>
        </div>
    </div>
    <?php view("inc/footer"); ?>
    <script type="text/javascript">
    $(function() {//gatilhos
        $('#s').val('').focus();
        baixarLinks(nextId);

        $("#s").keyup(function() {
            buscarLinks($(this).val());
        });
    });
</script>
</body>
</html>
