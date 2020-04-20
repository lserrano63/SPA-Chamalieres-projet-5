<?php
require ('Models/postManager.php');
require ('Models/commentManager.php');
require ('Models/bioManager.php');
session_start();

if (isset($_GET['action']))
{
    require('Views/router.php');
} else {
    require('Views/indexView.php');
}