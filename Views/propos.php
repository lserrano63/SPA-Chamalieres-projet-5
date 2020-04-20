<?php $title = "A propos de moi";?>
<?php ob_start(); ?>

<section class="container bg-secondary">
    <section class="mt-2 mb-2 p-1">
        <div class="bg-light mt-2 mb-2 p-2">
            <h3 class="text-center">A propos de moi :</h3>
            <?php
            $bioManager = new BioManager();
            $getBio = $bioManager->getBiography();
            while ($getTheBio = $getBio->fetch()) {
            ?>
                <p><?= $getTheBio['bio']; ?></p>
            </div>
            <div class="bg-light mt-2 mb-2 p-2">
                <h3 class="text-center">Me contacter :</h3>
                <p><?= $getTheBio['contact']; ?></p>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
</section>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>