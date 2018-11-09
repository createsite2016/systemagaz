<?php

function get_cache_path($path,$simvols){
    mb_internal_encoding("UTF-8");
    $result = mb_substr( $path, $simvols); // тут происходит обрезание пути к картинке
    return $result;
}