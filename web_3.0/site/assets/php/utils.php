<?php

function distinct_key($tableau, $on){
    $data = [];
    foreach($tableau as $value => $key){
        if ( !in_array($tableau[$value][$on], $data) ) {
            array_push($data, $tableau[$value][$on]);
        }
    }
    return $data;
}