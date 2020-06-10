<?php $title = "Administration des fiches animales" ?>
<?php ob_start(); ?>

<section class="container rounded bg-secondary mt-3 pt-1 pb-3">
<?php 
    $animalManager = new \App\Models\AnimalManager();
    $animals = $animalManager->getAnimals();
    foreach ($animals as $data) 
    {
        ?>
        <article class="container bg-light mt-3 pb-2">
            <h2 class="text-center"><?= $data['name'];?></h2>
            <p class="text-center">fiche créee le <?= $data['creation_date_fr'];?></p>
            <p><?= substr(nl2br($data['description']),0,400);?></p>
            <div class="text-center">
                <a href="https://projetsls.fr/SPA-Chamalieres/Modification-Animal-<?= $data['id']; ?>" title="Modifier la fiche" class="btn btn-primary"><i class="far fa-edit"></i></a>
                <a href="https://projetsls.fr/SPA-Chamalieres/Suppression-Animal-<?= $data['id']; ?>" title="Supprimer la fiche" class="btn btn-primary" data-toggle="modal" data-target="#modal_<?= $data['id']; ?>"><i class="far fa-trash-alt"></i></a>
            </div>
            <div class="modal fade" id="modal_<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alerte</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Voulez-vous vraiment supprimer cette fiche ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <a href="https://projetsls.fr/SPA-Chamalieres/Suppression-Animal-<?= $data['id']; ?>" class="btn btn-primary" >Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <?php
    }
    ?>
</section>

<script src="scripts/tiny.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>