<?php
controller('feedBot');

function read_from_console ($prompt = '') {
    if ( function_exists('readline') ) {
        $line = trim(readline($prompt));
        if (!empty($line)) {
            readline_add_history($line);
        }
    } else {
        echo $prompt;
        $line = trim(fgets(STDIN));
    }
    return $line;
}
