<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="images/favicon.jpg">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/f42ba57ba1.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://cdn.tiny.cloud/1/tarq1lkuc10asmbe1nph78zrm6tf4x6ktxc9qqblqgz4bcva/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <link href="css/style.css" rel="stylesheet"/>
        <title><?= $title ?></title>
    </head>
        
    <body>
        <header>
            <nav class="d-flex justify-content-center text-center">
                <ul class="container nav row">
                    <div class="col-12 d-flex flex-wrap">
                        <?php 
                            if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
                            ?>
                            <li class="nav-item col-sm-3 col-6"><a class="nav-link" href="index.php">Accueil</a></li>
                            <li class="nav-item col-sm-3 col-6"><a class="nav-link" href="?action=propos">A propos</a></li>
                            <li class="nav-item col-sm-3 col-6"><a class="nav-link" href="?action=admin">Administration</a></li>
                            <li class="nav-item col-sm-3 col-6"><a class="nav-link" href="?action=disconnect">Déconnexion</a></li>
                            <?php    
                            } else {
                            ?>
                                <li class="nav-item col-sm-6 col-6"><a class="nav-link" href="index.php">Accueil</a></li>
                                <li class="nav-item col-sm-6 col-6"><a class="nav-link" href="?action=propos">A propos</a></li>
                        <?php        
                            }
                        ?>
                    </div>   
                </ul>
            </nav>
        </header>
        <?= $content ?>
    </body>
</html>