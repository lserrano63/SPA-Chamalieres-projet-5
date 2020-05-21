<?php

$datamanager = new \App\Models\Data_to_json();
$getjson = $datamanager->all_spas();
$json_array = array();
while  ($getTheJson = $getjson->fetch()) {
    $json_array[] = $getTheJson;
}
echo(json_encode($json_array));
