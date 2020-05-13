<?php
require ('Models/postManager.php');
require ('Models/commentManager.php');
require ('Models/animalManager.php');
require ('Models/userManager.php');

if (isset($_GET['action']))
{
    $_SESSION['connected'] = true;
    require('Views/router.php');
} else {
    $_SESSION['connected'] = true;
    require('Views/Public/indexView.php');
}