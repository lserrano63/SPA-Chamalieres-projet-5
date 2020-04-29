<?php

$action = $_GET['action'];

if($action == 'spajson')
{
    require('Models/data_to_json.php');
    require('Views/Private/spa_json.php');
}