<?php $title = "Administration" ?>
<?php ob_start(); ?>

<section class="container mt-3">
    <ul class="container list-unstyled d-flex justify-content-center flex-column">
        <li class="btn btn-secondary mt-3"><a class="text-light" href="?action=postCreation">Nouveau post</a></li>
        <li class="btn btn-secondary mt-3"><a class="text-light" href="?action=adminPost">Administration des posts</a></li>
        <li class="btn btn-secondary mt-3"><a class="text-light" href="?action=formAnimal">Ajouter une fiche d'un animal</a></li>
        <li class="btn btn-secondary mt-3"><a class="text-light" href="?action=adminAnimal">Administration des fiches animales</a></li>
        <li class="btn btn-secondary mt-3"><a class="text-light" href="?action=viewComments">Gérer Commentaires</a></li>
        <li class="btn btn-secondary mt-3"><a class="text-light" href="?action=adminRights">Rôles utilisateurs</a></li>
    </ul>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('Views/template.php'); ?>