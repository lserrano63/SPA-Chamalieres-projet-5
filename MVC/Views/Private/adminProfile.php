<?php $title = "Gestion de votre compte administrateur" ?>
<?php ob_start(); ?>

<section class="container">
    <div class="card card-container">
        <h3 class="card-header">Modification de votre mot de passe :</h2>
        <div class="card-body">
            <div class="login-form">
                <form action="https://projetsls.fr/SPA-Chamalieres/Modification-Profil" method="post">
                    <div class="form-group">
                        <label for="password">Nouveau mot de passe :</label>
                        <input name="password" type="password" id="password" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="password_check">Retapez votre nouveau mot de passe :</label>
                        <input name="password_check" type="password" id="password_check" class="form-control" required/>
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