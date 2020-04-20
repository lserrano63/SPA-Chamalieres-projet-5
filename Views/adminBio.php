<?php $title = "Modification de biographie";?>
<?php ob_start(); ?>

<section class="container">
    <section class="card card-container">
        <?php
            $bioManager = new BioManager();
            $getBio = $bioManager->getBiography();
            while ($getTheBio = $getBio->fetch()) {
            ?>
            <h3 class="card-header">Modifier votre biographie</h2>
            <div class="card-body">
                <div class="login-form">
                    <form action="index.php?action=adminBioModified" method="post">
                        <div class="form-group">
                            <label class="font-weight-bold" for="bio">Biographie :</label>
                            <textarea name="bio" type="text" id="bio" class="form-control"><?= $getTheBio['bio'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="post">Contact :</label>
                            <textarea required name="contact" type="text" id="contact" class="form-control"><?= $getTheBio['contact'];?></textarea>
                        </div>
                        <input type="submit" name="send_post" class="btn btn-primary" value="Envoyer"/>
                    </form>
                </div>
            </div>
        <?php
            }
        ?>
    </section>
</section>

<script src="scripts/tiny.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>