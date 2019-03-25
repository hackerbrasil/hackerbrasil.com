<?php
if(isset($_GET['night'])){
    view('inc/cyborg');
}else{
    view('inc/bs2');
}
 ?>
<link rel="stylesheet" href="/css/style.css?v1">
<link rel="stylesheet" href="/css/bootstrap-modal.css">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/flags/br.svg">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/flags/br.svg">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/flags/br.svg">
<link rel="apple-touch-icon-precomposed" href="/img/flags/br.svg">
<link rel="shortcut icon" href="/img/flags/br.svg">
<meta property="og:image" content="<?php print $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"];?>/img/br.png">
