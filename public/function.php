<?php


function before ($thi, $inthat){
    
    return substr($inthat, 0, strpos($inthat, $thi));
}