<?php $title = "Bienvenue sur le site de la SPA de Chamalières"; ?>

<?php ob_start(); ?>

<section id="infos_and_map">
    <section id="infos">
    </section>
    <aside id="map">
    </aside>
</section>

<section id="diaporama">
</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>