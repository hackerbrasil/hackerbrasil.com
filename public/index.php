<?php
require '../config.php';
require '../inc/segment.php';
require '../inc/view.php';

$segment=segment();
if(@$segment[1]=='/'){
        view("home");
}
