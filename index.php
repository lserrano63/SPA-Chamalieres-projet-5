<?php
require ('Models/postManager.php');
require ('Models/commentManager.php');
require ('Models/animalManager.php');

if (isset($_GET['action']))
{
    require('Views/router.php');
} else {
    require('Views/Public/indexView.php');
}