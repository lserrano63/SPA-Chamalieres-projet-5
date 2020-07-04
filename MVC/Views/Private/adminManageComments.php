<?php $title = "Administration des commentaires" ?>
<?php ob_start(); ?>

<section id="adminComments" class="pt-2 pb-4">
    <section class="container rounded bg-secondary mt-3 pb-2">
        <h3 class="text-center">Commentaires signalés depuis vos posts</h3>
            <?php
            foreach ($reportedCommentsPosts as $reportedFromPost) {
            ?>
                <div class="bg-light mb-3 p-1">
                    <p><strong><?= htmlspecialchars($reportedFromPost['author']); ?></strong> le <?= $reportedFromPost['comment_date_fr']; ?></p>
                    <p><?= nl2br(htmlspecialchars($reportedFromPost['comment'])); ?></p>
                    <a href="https://projetsls.fr/SPA-Chamalieres/Accepter-Commentaire-Post-<?=$reportedFromPost['id']; ?>" title="Accepter commentaire"><i class="fas fa-check"></i></a>
                    <a href="https://projetsls.fr/SPA-Chamalieres/Suppression-Commentaire-Post-<?=$reportedFromPost['id']; ?>" title="Supprimer commentaire"><i class="far fa-trash-alt"></i></a>
                </div>
            <?php
            }
            ?>
    </section>

    <section class="container rounded bg-secondary mt-3 pb-2">
        <h3 class="text-center">Commentaires signalés depuis vos animaux</h3>
            <?php
            foreach ($reportedCommentsAnimals as $reportedFromAnimals) {
            ?>
                <div class="bg-light mb-3 p-1">
                    <p><strong><?= htmlspecialchars($reportedFromAnimals['author']); ?></strong> le <?= $reportedFromAnimals['comment_date_fr']; ?></p>
                    <p><?= nl2br(htmlspecialchars($reportedFromAnimals['comment'])); ?></p>
                    <a href="https://projetsls.fr/SPA-Chamalieres/Accepter-Commentaire-Animal-<?=$reportedFromAnimals['id']; ?>" title="Accepter commentaire"><i class="fas fa-check"></i></a>
                    <a href="https://projetsls.fr/SPA-Chamalieres/Suppression-Commentaire-Animal-<?=$reportedFromAnimals['id']; ?>" title="Supprimer commentaire"><i class="far fa-trash-alt"></i></a>
                </div>
            <?php
            }
            ?>
    </section>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>