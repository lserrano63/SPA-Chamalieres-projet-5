<?php
require ("vendor/autoload.php");

session_start();
//error_reporting(E_ALL);

$frontEndController = new \App\frontend\FrontEndController();
$backEndController = new \App\backend\BackEndController();

if (isset($_GET['action']))
{
    require('MVC/Views/router.php');
} else {
    $frontEndController->indexView();
}