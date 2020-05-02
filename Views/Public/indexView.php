<?php ob_start(); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
<?php $additionnalHead = ob_get_clean(); ?>

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
<?php require('Views/template.php'); ?>
<script src="scripts/map.js"></script>
<script src="scripts/slider.js"></script>