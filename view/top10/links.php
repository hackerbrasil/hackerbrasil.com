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
                <h1>Top 10 links</h1>
                <ul class="nav nav-tabs nav-stacked listaDeLinks">
                    <?php
                    $i=1;
                    foreach($links as $link){
                        if($i<10){
                            $space='&nbsp;&nbsp;';
                        }else{
                            $space='';
                        }
                        $badge='<span class="badge">'.$space.$i++.'°</span> ';
                        $html='<a href="'.$link['url'].'">'.$badge.$link['title'].'</a>';
                        $data='<span class="pull-right badge-right" x-date="'.$link['created_at'].'"></span>';
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
