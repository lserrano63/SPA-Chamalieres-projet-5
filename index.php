<?php
require ('Models/postManager.php');
require ('Models/commentManager.php');

if (isset($_GET['action']))
{
    require('Views/router.php');
} else {
    require('Views/Public Views/indexView.php');
}