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
                <h1>Top 10 sites</h1>
                <ul class="nav nav-tabs nav-stacked listaDeLinks">
                    <?php
                    $i=1;
                    foreach($sites as $site){
                        if($i<10){
                            $space='&nbsp;&nbsp;';
                        }else{
                            $space='';
                        }
                        $badge='<span class="badge">'.$space.$i++.'°</span> ';
                        $html='<a onclick="javascript:abrirPaginaDoFeed('.$site['id'].')" href="javascript:void();">'.$badge.$site['name'].'</a>';
                        $data='<span class="pull-right badge-right" x-date="'.$site['created_at'].'"></span>';
                        print '<li>'.$data.$html.'</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php view("inc/footer"); ?>
    <script type="text/javascript">
    setInterval(atualizarADataDosLinks, 100);
</script>
