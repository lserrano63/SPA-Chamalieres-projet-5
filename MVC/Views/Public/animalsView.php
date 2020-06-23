<?php ob_start(); ?>

<section id="animals" class="container rounded bg-secondary pt-3 pb-1">
    <ul>
        <li id="chat">chat</li>
        <li id="chien">chien</li>
        <li id="hamster">hamster</li>
        <li id="rat">rat</li>
        <li id="lapin">lapin</li>
        <li id="perroquet">perroquet</li>
        <li id="poisson">poisson</li>
        <li id="serpent">serpent</li>
        <li id="souris">souris</li>
        <li id="tortue">tortue</li>
    </ul>
    <?php
        $animalManager = new \App\Models\AnimalManager();
        $animals = $animalManager->getAllAnimals();
        foreach ($animals as $data) 
        {
            ?>
            <article class="container bg-light animals" data-animal-type="<?=$data['type'];?>">
                <h2 class="text-center"><?= $data['name'];?></h2>
                <p class="text-center">posté le <?= $data['creation_date_fr'];?></p>
                <p class="text-center"><img src="images/animals/<?= $data['id'];?>.jpg"></p>
                <p><?= substr(nl2br($data['description']),0,300);?> ...<br>
                <a class="btn btn-primary mb-1" href="https://projetsls.fr/SPA-Chamalieres/Animaux/Animal-<?= $data['id']; ?>">Voir plus</a></p>    
            </article>
            <?php
        }
            ?>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>
<script src="scripts/animalSort.js"></script>