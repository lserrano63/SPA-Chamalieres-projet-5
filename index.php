<?php
require ('Models/postManager.php');
require ('Models/commentManager.php');
require ('Models/animalManager.php');
require ('Models/userManager.php');
session_start();
error_reporting(E_ALL);

if (isset($_GET['action']))
{
    require('Views/router.php');
} else {
    require('Views/Public/indexView.php');
}