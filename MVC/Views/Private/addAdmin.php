<?php $title = "Création de votre compte administrateur" ?>
<?php ob_start(); ?>

<section class="container">
    <div class="card card-container">
        <h3 class="card-header">Nouvel administrateur :</h2>
        <div class="card-body">
            <div class="login-form">
                <form action="index.php?action=accountCreated" method="post">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input name="name" type="text" id="name" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe :</label>
                        <input name="password" type="password" id="password" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input name="email" type="email" id="email" class="form-control" required/>
                    </div>

                    <input type="submit" name="send" class="btn btn-primary" value="Envoyer"/>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="scripts/tiny.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>