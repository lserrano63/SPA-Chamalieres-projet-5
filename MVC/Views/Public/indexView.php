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

<section id="infos" class="pt-2 pb-4">
    <h2 class="text-center">Nos dernières actualités</h2>
    <div class="container rounded bg-secondary pt-3 pb-1">
    <?php
        $postManager = new \App\Models\PostManager();
        $postsIndex = $postManager->getPostsIndex();
        foreach ($postsIndex as $data) 
        {
            ?>
            <article class="container bg-light">
                <h2 class="text-center"><?= $data['title'];?></h2>
                <p class="text-center">posté le <?= $data['creation_date_fr'];?></p>
                <p><?= substr(nl2br($data['post']),0,300);?> ...<br>
                <a class="btn btn-primary mb-1 rounded" href="https://projetsls.fr/SPA-Chamalieres/Posts/Post-<?= $data['id']; ?>">Voir plus</a></p>    
            </article>
            <?php
        }
            ?>
    </div>
</section>

<section id="map_h2"class="pt-2 pb-4">
    <h2 class="text-center">Retrouvez tous les sites de la SPA en France</h2>
    <div id="map" class="m-auto rounded">
    </div>
</section>

<section id="slider" class="pt-2 pb-4">
    <h2 class="text-center">Nos derniers arrivants au refuge</h2>
	<div id="slider_all_images" class="mt-4 mb-2">
        <figure class="slider_image text-center">
			<img class="img-fluid" src="images/spa_refuge.jpg" alt="Diaporama des nouveaux arrivants au refuge">
			<figcaption>Voici les nouveaux arrivants au refuge :</figcaption>
		</figure>
    <?php 
    $animalManager = new \App\Models\AnimalManager();
    $slider = $animalManager->sliderAnimals();
    foreach ($slider as $data) 
    {
    ?>
		<figure class="slider_image not_visible text-center">
			<img class="img-fluid" src="images/animals/<?= $data['id'];?>.jpg" alt="<?= $data['name'];?>">
			<figcaption><a href="https://projetsls.fr/SPA-Chamalieres/Animaux/Animal-<?= $data['id'];?>"><?= $data['name'];?></a></figcaption>
		</figure>
    <?php
    }
    ?>
	</div>
	<div id="slider_buttons" class="d-flex m-auto align-items-center">
		<button id="button_left"><i class="fas fa-arrow-circle-left fa-3x"></i></button>
		<button id="button_right"><i class="fas fa-arrow-circle-right fa-3x"></i></button>
		<button id="button_pause"><i class="fas fa-pause-circle fa-3x"></i></button>
		<button id="button_play" class="not_visible"><i class="fas fa-play-circle fa-3x"></i></button>
	</div>
</section>

<section id="don" class="pt-2 pb-4 text-center">
    <div class="d-flex flex-column">
        <h2>Participez</h2>
        <p class="m-auto pb-2">Aidez-nous à mener à bien nos missions ! La SPA vit principalement de la générosité du public et compte donc sur votre soutien pour secourir, défendre et protéger les animaux.</p>
        <a class="mb-2" href="https://soutenir.la-spa.fr/b/mon-don"><img class="img-fluid rounded" src="/SPA-Chamalieres/images/dog_don.jpg"></a>
        <a class="btn btn-primary m-auto rounded" href="https://soutenir.la-spa.fr/b/mon-don">Je fais un don</a>
    </div>
</section>

<section id="contact" class="row d-flex text-center justify-content-center m-auto">
    <div class="container">
        <h3>Pour nous contacter :</h3>
        <p class="font-weight-bold">Société Protectrice des Animaux,<br>
        124 Avenue Joseph Claussat 63400 Chamalieres<br>
        <i class="fas fa-phone-alt"></i>
        <a href="tel:+33411223344">0411223344</a><br>
        <i class="fas fa-at"></i>
        Pour nous écrire, cliquez <a href="mailto:spa.chamalieres.contact@gmail.com">ici</a>.</p>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>
<script src="scripts/map.js"></script>
<script src="scripts/slider.js"></script>