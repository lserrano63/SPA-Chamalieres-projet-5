<?php

$datamanager = new Data_to_json();
$getjson = $datamanager->data_to_json();
$json_array = array();
while  ($getTheJson = $getjson->fetch()) {
    $json_array[] = $getTheJson;
}
echo(json_encode($json_array));
