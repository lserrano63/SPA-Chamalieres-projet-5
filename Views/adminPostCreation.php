<?php $title = "Création de post" ?>
<?php ob_start(); ?>

<section class="container">
    <div class="card card-container">
        <h3 class="card-header">Ajouter votre post</h2>
        <div class="card-body">
            <div class="login-form">
                <form action="index.php?action=addPost" method="post">
                    <div class="form-group">
                        <label for="title">Titre :</label>
                        <input name="title" type="text" id="title" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="post">Post :</label>
                        <textarea required type="text" name="post" id="post" class="form-control"></textarea>
                    </div>
                    <input type="submit" name="send_post" class="btn btn-primary" value="Envoyer"/>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="scripts/tiny.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>