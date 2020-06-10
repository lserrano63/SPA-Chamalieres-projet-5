<?php $title = "Administration" ?>
<?php ob_start(); ?>

<section class="container mt-3">
    <ul class="container list-unstyled d-flex justify-content-center flex-column">
        <li class="btn btn-secondary mt-3"><a class="text-light" href="https://projetsls.fr/SPA-Chamalieres/Nouveau-Post">Nouveau post</a></li>
        <li class="btn btn-secondary mt-3"><a class="text-light" href="https://projetsls.fr/SPA-Chamalieres/Administration-Post/Page-1">Administration des posts</a></li>
        <li class="btn btn-secondary mt-3"><a class="text-light" href="https://projetsls.fr/SPA-Chamalieres/Ajouter-Animal">Ajouter une fiche d'un animal</a></li>
        <li class="btn btn-secondary mt-3"><a class="text-light" href="https://projetsls.fr/SPA-Chamalieres/Administration-Animaux">Administration des fiches animales</a></li>
        <li class="btn btn-secondary mt-3"><a class="text-light" href="https://projetsls.fr/SPA-Chamalieres/Administration-Commentaires">Gérer Commentaires</a></li>
        <li class="btn btn-secondary mt-3"><a class="text-light" href="https://projetsls.fr/SPA-Chamalieres/Ajouter-Administrateur">Rôles utilisateurs</a></li>
        <li class="btn btn-secondary mt-3"><a class="text-light" href="https://projetsls.fr/SPA-Chamalieres/Profil">Profil</a></li>
    </ul>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>