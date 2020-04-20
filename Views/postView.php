<?php $title = $post['title']; ?>
<?php ob_start(); ?>
<section class="container bg-secondary mt-2 mb-1 p-2">
    <p><a href="index.php" class="text-light">Retour à la liste des chapitres</a></p>
    <article class="news bg-light mt-2 mb-2 p-2">
        <h3 class="text-center">
            <?= $post['title']; ?>
            <em>le <?= $post['creation_date_fr']; ?></em>
        </h3>
                
        <p>
            <?= nl2br($post['post']); ?>
        </p>
    </article>

    <section id="comments" class="bg-light mt-2 mb-2 p-3">
        <h3 class="text-center">Commentaires</h3>
            <?php
            while ($comment = $comments->fetch()){
            ?>
                <div id="comment" class="comment position-relative">
                    <p><strong><?= htmlspecialchars($comment['author']); ?></strong> le <?= $comment['comment_date_fr']; ?></p>
                    <p><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>                   
                    <a id="report_button" href="index.php?action=reported&id=<?= $comment['id']?>&post_id=<?= $post['id']?>" title="Signaler"><i class="fas fa-ban btn btn-primary"></i></a>
                </div>
            <?php
            }
            ?>
    </section>
    <section class="container mb-2 ">
        <div class="card card-container">
            <h3 class="card-header">Ajouter votre commentaire</h2>
            <div class="card-body">
                <div class="login-form">
                    <form action="index.php?action=addComment&id=<?= $post['id'] ?>" method="post">
                        <div class="form-group">
                            <label for="pseudo">Nom :</label>
                            <input name="author" type="text" id="author" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="message">Message :</label>
                            <textarea type="text" name="comment" id="comment" class="form-control" required></textarea>
                        </div>
                        <div class="form-group text-center">
                            <label for="check">Voulez-vous accepter la <a href="?action=mentions">politique de confidentialité</a> : </label>
                            <input type="checkbox" name="check" id="check" class="form-control" required>
                        </div>
                        <input type="submit" name="send_message" class="btn btn-primary" value="Envoyer"/>
                    </form>
                </div>
            </div>
        </div>
    </section>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>