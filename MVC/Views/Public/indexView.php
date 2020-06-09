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

    <section class="container rounded bg-secondary pt-3 pb-1">
    <?php 
        $backEndController = new \App\backend\BackEndController();
        $backEndController->generatePassword(10);
        $postManager = new \App\Models\PostManager();
        $postsIndex = $postManager->getPostsIndex();
        foreach ($postsIndex as $data) 
        {
            ?>
            <article class="container bg-light">
                <h2 class="text-center"><?= $data['title'];?></h2>
                <p class="text-center">posté le <?= $data['creation_date_fr'];?></p>
                <p><?= substr(nl2br($data['post']),0,300);?> ...<br>
                <a class="btn btn-primary mb-1" href="?action=viewPost&id=<?= $data['id']; ?>">Voir plus</a></p>    
            </article>
            <?php
        }
            ?>
    </section>
    <aside id="map">
    </aside>
</section>

<section id="slider">
	<div id="slider_all_images">
        <figure class="slider_image">
			<img src="images/">
			<figcaption>Voici les nouveaux arrivants au refuge :</figcaption>
		</figure>
    <?php 
    $animalManager = new \App\Models\AnimalManager();
    $req = $animalManager->sliderAnimals();
    while ($data = $req->fetch()) 
    {
        ?>

		<figure class="slider_image not_visible">
			<img src="images/animals/<?= $data['id'];?>.jpg">
			<figcaption><a href="?action=viewAnimal&id=<?= $data['id'];?>"><?= $data['name'];?></a></figcaption>
		</figure>
        <?php
    }
        $req->closeCursor();
    ?>
	</div>
		
	<div id="slider_buttons">
		<button id="button_left"><i class="fas fa-arrow-circle-left fa-3x"></i></button>
		<button id="button_right"><i class="fas fa-arrow-circle-right fa-3x"></i></button>
		<button id="button_pause"><i class="fas fa-pause-circle fa-3x"></i></button>
		<button id="button_play" class="not_visible"><i class="fas fa-play-circle fa-3x"></i></button>
	</div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>
<script src="scripts/map.js"></script>
<script src="scripts/slider.js"></script>