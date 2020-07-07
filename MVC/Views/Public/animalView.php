<?php $title = $animal['name']; ?>
<?php ob_start(); ?>
<section id="animal" class="pt-2 pb-4">
    <div class="container rounded bg-secondary pt-3 pb-2">
        <article class="news bg-light p-2">
            <h3 class="text-center">
                <?= $animal['name']; ?>
                <em>le <?= $animal['creation_date_fr']; ?></em>
            </h3>
            <p class="text-center"><img class="img-fluid" alt ="<?= $animal['name'];?> qui est un <?=$animal['type'] ;?>" src="../images/animals/<?= $animal['id'];?>.jpg"></p>
            <?php if($animal['sexe'] === "male") {
                ?>
                <p><?= ucfirst($animal['name']); ?> est un <?=$animal['sexe'];?> et a <?=$animal['age'];?> an(s).</p>
            <?php
            } else {
                ?>
                <p><?= ucfirst($animal['name']); ?> est une <?=$animal['sexe'];?> et a <?=$animal['age'];?> an(s).</p>
            <?php
            }
            ?>
            
            <p><?= nl2br($animal['description']); ?>
        </article>

        <section id="comments" class="bg-light mt-2 mb-2 p-3">
            <h3 class="text-center">Commentaires</h3>
            <?php foreach ($animalComments as $comments) 
            {
            ?>
                <div class="div_comment comment position-relative">
                    <p><strong><?= htmlspecialchars($comments['author']); ?></strong> le <?= $comments['comment_date_fr']; ?></p>
                    <p><?= nl2br(htmlspecialchars($comments['comment'])); ?></p>
                    <a class="report_button" href="https://projetsls.fr/SPA-Chamalieres/Signalement/Commentaire-<?= $comments['id']?>-Animal-<?= $animal['id']?>" title="Signaler"><i class="fas fa-ban btn btn-primary"></i></a>
                </div>
            <?php
            }
            ?>
        </section>
        <section class="container mb-2 p-0">
            <div class="card card-container">
                <h3 class="card-header">Ajouter votre commentaire</h3>
                <div class="card-body">
                    <div class="login-form">
                        <form action="https://projetsls.fr/SPA-Chamalieres/Ajout-Commentaire/Animal-<?= $animal['id'] ?>" method="post">
                            <div class="form-group">
                                <label for="author">Nom :</label>
                                <input name="author" type="text" id="author" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="comment">Message :</label>
                                <textarea name="comment" id="comment" class="form-control" required></textarea>
                            </div>
                            <div class="form-group text-center">
                                <label for="check">Voulez-vous accepter la <a href="https://projetsls.fr/SPA-Chamalieres/Mentions-Légales">politique de confidentialité</a> : </label>
                                <input type="checkbox" name="check" id="check" class="form-control" required>
                            </div>
                            <input type="submit" name="send_message" class="btn btn-primary" value="Envoyer"/>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>