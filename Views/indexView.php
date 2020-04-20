<?php $title = "Billet simple pour l'Alaska"; ?>

<?php ob_start(); ?>
    <section class="container-fluid p-0 m-0" id="section_img">
        <figure class="position-relative">
            <img class="figure-img img-fluid" src="images/1.jpg" alt="Alaska's lake"/>
            <figcaption class="position-absolute text-light text-center">Billet simple pour l'Alaska<br>
            de Jean Forteroche
            </figcaption>
        </figure>
    </section>
    <section class="container rounded bg-secondary pt-3 pb-1">
    <?php 
        $postManager = new PostManager();
        $req = $postManager->getPosts();
        while ($data = $req->fetch()) 
        {
            ?>
            <article class="container bg-light">
                <h2 class="text-center"><?= $data['title'];?></h2>
                <p class="text-center">posté le <?= $data['creation_date_fr'];?></p>
                <p><?= substr(nl2br($data['post']),0,300);?> ...<br>
                <a class="btn btn-primary mb-1" href="?action=viewPost&id=<?= $data['id']; ?>">Voir plus</a></p>    
            </article>
            <?php
        }
            $req->closeCursor();
            ?>
    </section>
<footer class="container navbar">
    <div class="container row d-flex text-center justify-content-center m-auto">
        <ul id="social_networks" class="d-flex col-12 col-sm-6 justify-content-around list-unstyled p-0">
            <li><a href=""><i class="fab fa-twitter fa-2x"></i></a></li>
            <li><a href=""><i class="fab fa-facebook fa-2x"></i></a></li>
            <li><a href=""><i class="fab fa-instagram fa-2x"></i></a></li>
        </ul>
        <a class="col-6 col-sm-3 p-0" href="?action=mentions">Mentions légales</a>
        <a class="col-6 col-sm-3 p-0" href="?action=login">Connection</a>
        <p class="col-12 mb-0 font-italic p-0">Copyright © All rights reserved. Billet simple pour l'Alaska 2020</p>
    </div>
</footer>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>