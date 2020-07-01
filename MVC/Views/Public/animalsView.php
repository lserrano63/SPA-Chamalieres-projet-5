<?php ob_start(); ?>

<section id="animals" class="pt-2 pb-4">
    <div class="container rounded bg-secondary pt-3 pb-1">
        <nav class="d-flex justify-content-center text-center p-0 mb-2">
            <ul class="container nav row p-0">
                <div class="col-12 d-flex flex-wrap p-0 text-center">
                    <li id="chat" class="btn btn-primary mr-1 mb-1">Chat</li>
                    <li id="chien" class="btn btn-primary mr-1 mb-1">Chien</li>
                    <li id="hamster" class="btn btn-primary mr-1 mb-1">Hamster</li>
                    <li id="rat" class="btn btn-primary mr-1 mb-1">Rat</li>
                    <li id="lapin" class="btn btn-primary mr-1 mb-1">Lapin</li>
                    <li id="perroquet" class="btn btn-primary mr-1 mb-1">Perroquet</li>
                    <li id="poisson" class="btn btn-primary mr-1 mb-1">Poisson</li>
                    <li id="serpent" class="btn btn-primary mr-1 mb-1">Serpent</li>
                    <li id="souris" class="btn btn-primary mr-1 mb-1">Souris</li>
                    <li id="tortue" class="btn btn-primary mr-1 mb-1">Tortue</li>
                    <li id="all" class="btn btn-primary mr-1 mb-1">Tous les types</li>
                </div>
            </ul>
        </nav>
        <section id="all_animals">
            <span id="messageNoItem" class="not_visible text-center m-auto">Rien n'a été trouvé lors de votre recherche !</span>
        <?php
            $animalManager = new \App\Models\AnimalManager();
            $animals = $animalManager->getAllAnimals();
            foreach ($animals as $data) 
            {
                ?>
                <article class="container bg-light animals mb-2" data-animal-type="<?=$data['type'];?>">
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
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>
<script src="scripts/animalSort.js"></script>