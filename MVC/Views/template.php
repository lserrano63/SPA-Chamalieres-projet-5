<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/f42ba57ba1.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://cdn.tiny.cloud/1/tarq1lkuc10asmbe1nph78zrm6tf4x6ktxc9qqblqgz4bcva/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <link href="/SPA-Chamalieres/css/style.css" rel="stylesheet"/>
        <?= $additionnalHead ?>
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
                        <li class="nav-item col-sm-3 col-3"><a class="nav-link" href="https://projetsls.fr/SPA-Chamalieres/Acceuil">Accueil</a></li>
                        <li class="nav-item col-sm-3 col-3"><a class="nav-link" href="https://projetsls.fr/SPA-Chamalieres/Contact">Contact</a></li>
                        <li class="nav-item col-sm-3 col-3"><a class="nav-link" href="https://projetsls.fr/SPA-Chamalieres/Nos-Animaux">Animaux</a></li>
                        <li class="nav-item col-sm-3 col-3"><a class="nav-link" href="https://projetsls.fr/SPA-Chamalieres/Actualités/Page-1">Actualités</a></li>
                        <li class="nav-item col-sm-6 col-6"><a class="nav-link" href="https://projetsls.fr/SPA-Chamalieres/Administration">Administration</a></li>
                        <li class="nav-item col-sm-6 col-6"><a class="nav-link" href="https://projetsls.fr/SPA-Chamalieres/Déconnexion">Déconnexion</a></li>
                        <?php    
                        } else {
                        ?>
                        <li class="nav-item col-sm-3 col-3"><a class="nav-link" href="https://projetsls.fr/SPA-Chamalieres/Acceuil">Accueil</a></li>
                        <li class="nav-item col-sm-3 col-3"><a class="nav-link" href="https://projetsls.fr/SPA-Chamalieres/Contact">Contact</a></li>
                        <li class="nav-item col-sm-3 col-3"><a class="nav-link" href="https://projetsls.fr/SPA-Chamalieres/Nos-Animaux">Animaux</a></li>
                        <li class="nav-item col-sm-3 col-3"><a class="nav-link" href="https://projetsls.fr/SPA-Chamalieres/Actualités/Page-1">Actualités</a></li>
                    <?php        
                        }
                    ?>
                    </div>   
                </ul>
            </nav>
        </header>
    
        <?= $content ?>

        <footer class="container navbar page-footer">
            <div class="container row d-flex text-center justify-content-center m-auto">
                <ul id="social_networks" class="d-flex col-12 col-sm-6 justify-content-around list-unstyled p-0">
                    <li><a href=""><i class="fab fa-twitter fa-2x"></i></a></li>
                    <li><a href=""><i class="fab fa-facebook fa-2x"></i></a></li>
                    <li><a href=""><i class="fab fa-instagram fa-2x"></i></a></li>
                </ul>
                <?php 
                if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
                ?>
                <a class="col-6 col-sm-6 p-0" href="https://projetsls.fr/SPA-Chamalieres/Mentions-Légales">Mentions légales</a>
                <p class="col-12 mb-0 font-italic p-0">Copyright © All rights reserved. SPA Chamalières 2020</p>
                <?php
                } else {
                ?>
                    <a class="col-6 col-sm-6 p-0" href="https://projetsls.fr/SPA-Chamalieres/Mentions-Légales">Mentions légales</a>
                    <p class="col-12 mb-0 font-italic p-0">Copyright © All rights reserved. SPA Chamalières 2020</p>
                    <a class="col-6 col-sm-3 p-0" href="https://projetsls.fr/SPA-Chamalieres/Connection">Connection</a>
                <?php        
                   }
                ?>   
            </div>
        </footer>
    </body>
</html>