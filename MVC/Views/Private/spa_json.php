<?php

$json_array = array();
while  ($getTheJson = $getjson->fetch()) {
    $json_array[] = $getTheJson;
}
echo(json_encode($json_array));
