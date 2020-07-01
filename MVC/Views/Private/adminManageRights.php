<?php $title = "Ajout d'un nouvel administrateur" ?>
<?php ob_start(); ?>

<section id="adminRights" class="pt-2 pb-4">
    <div class="container">
        <div class="card card-container">
            <h3 class="card-header">Nouvel administrateur :</h2>
            <div class="card-body">
                <div class="login-form">
                    <form action="https://projetsls.fr/SPA-Chamalieres/Ajouter-Droits" method="post">
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input name="email" type="email" id="email" class="form-control" required/>
                        </div>
                        <input type="submit" name="send" class="btn btn-primary" value="Envoyer"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="scripts/tiny.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>