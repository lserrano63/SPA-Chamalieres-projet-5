<?php
require ("vendor/autoload.php");

session_start();
//error_reporting(E_ALL);

if (isset($_GET['action']))
{
    require('MVC/Views/router.php');
} else {
    require('MVC/Views/Public/indexView.php');
}