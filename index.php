<?php
require ('Models/postManager.php');
require ('Models/commentManager.php');

if (isset($_GET['action']))
{
    require('Views/router.php');
} else {
<<<<<<< HEAD
    require('Views/Public/indexView.php');
=======
    require('Views/Public Views/indexView.php');
>>>>>>> 7b3b67edad6c0d25fa2a15fbd9d7212fad138ea7
}