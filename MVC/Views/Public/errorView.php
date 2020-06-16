<?php ob_start(); ?>

<section id="error" class="container rounded bg-secondary pt-3 pb-1">
    <?php
        echo $errors;
    ?>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>