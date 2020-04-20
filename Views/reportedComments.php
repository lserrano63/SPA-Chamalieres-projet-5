<?php $title = "Administration de commentaires" ?>
<?php ob_start(); ?>

<section class="container rounded bg-secondary mt-3 pb-2">
    <h3 class="text-center">Commentaires signalés</h3>
        <?php
        
        $commentManager = new CommentManager();
        $reportedComment = $commentManager->getReportedComments();
        while ($reportedComments = $reportedComment->fetch()) {
        ?>
            <div class="bg-light mb-3 p-1">
                <p><strong><?= htmlspecialchars($reportedComments['author']); ?></strong> le <?= $reportedComments['comment_date_fr']; ?></p>
                <p><?= nl2br(htmlspecialchars($reportedComments['comment'])); ?></p>
                <a href="?action=accept&id=<?=$reportedComments['id']; ?>" title="Accepter commentaire"><i class="fas fa-check"></i></a>
                <a href="?action=remove&id=<?=$reportedComments['id']; ?>" title="Supprimer commentaire"><i class="far fa-trash-alt"></i></a>
            </div>
        <?php
        }
        ?>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>