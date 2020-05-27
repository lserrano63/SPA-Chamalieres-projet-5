<?php $title = "Administration des commentaires" ?>
<?php ob_start(); ?>

<section class="container rounded bg-secondary mt-3 pb-2">
    <h3 class="text-center">Commentaires signalés depuis vos posts</h3>
        <?php
        $commentManager = new \App\Models\CommentManager();
        $reportedCommentsPosts = $commentManager->getReportedCommentsPosts();
        foreach ($reportedCommentsPosts as $reportedFromPost) {
        ?>
            <div class="bg-light mb-3 p-1">
                <p><strong><?= htmlspecialchars($reportedFromPost['author']); ?></strong> le <?= $reportedFromPost['comment_date_fr']; ?></p>
                <p><?= nl2br(htmlspecialchars($reportedFromPost['comment'])); ?></p>
                <a href="?action=accept&id=<?=$reportedFromPost['id']; ?>" title="Accepter commentaire"><i class="fas fa-check"></i></a>
                <a href="?action=remove&id=<?=$reportedFromPost['id']; ?>" title="Supprimer commentaire"><i class="far fa-trash-alt"></i></a>
            </div>
        <?php
        }
        ?>
</section>

<section class="container rounded bg-secondary mt-3 pb-2">
    <h3 class="text-center">Commentaires signalés depuis vos animaux</h3>
        <?php
        $commentManager = new \App\Models\CommentManager();
        $reportedCommentsAnimals = $commentManager->getReportedCommentsAnimals();
        foreach ($reportedCommentsAnimals as $reportedFromAnimals) {
        ?>
            <div class="bg-light mb-3 p-1">
                <p><strong><?= htmlspecialchars($reportedFromAnimals['author']); ?></strong> le <?= $reportedFromAnimals['comment_date_fr']; ?></p>
                <p><?= nl2br(htmlspecialchars($reportedFromAnimals['comment'])); ?></p>
                <a href="?action=accept&id=<?=$reportedFromAnimals['id']; ?>" title="Accepter commentaire"><i class="fas fa-check"></i></a>
                <a href="?action=remove&id=<?=$reportedFromAnimals['id']; ?>" title="Supprimer commentaire"><i class="far fa-trash-alt"></i></a>
            </div>
        <?php
        }
        ?>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>