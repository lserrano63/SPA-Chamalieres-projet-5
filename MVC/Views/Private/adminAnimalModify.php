<?php $title = "Modification d'une fiche" ?>
<?php ob_start(); ?>

<section id="adminAnimalModify" class="pt-2 pb-4">
    <div class="container">
        <div class="card card-container">
            <h3 class="card-header">Modifier votre fiche animale</h2>
            <div class="card-body">
                <div class="login-form">
                    <form action="https://projetsls.fr/SPA-Chamalieres/Animal-Modifié-<?= $animalAdmin['id'];?>" method="post">
                        <div class="form-group">
                            <label for="name">Nom :</label>
                            <input name="name" type="text" id="name" class="form-control" value="<?= $animalAdmin['name'];?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description :</label>
                            <textarea required type="text" name="description" id="description" class="form-control"><?= $animalAdmin['description'];?></textarea>
                        </div>
                        <div class="form-group">
                        <label for="type">Type d'animal :</label>
                            <select id="type" name="type">
                                <option value="chat">Chat</option>
                                <option value="chien">Chien</option>
                                <option value="hamster">Hamster</option>
                                <option value="rat">Rat</option>
                                <option value="lapin">Lapin</option>
                                <option value="perroquet">perroquet</option>
                                <option value="poisson">Poisson</option>
                                <option value="serpent">Serpent</option>
                                <option value="souris">Souris</option>                                    
                                <option value="tortue">Tortue</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="age">Age :</label>
                            <select id="age" name="age">
                                <option value="0">0 an</option>
                                <option value="1">1 an</option>
                                <option value="2">2 ans</option>
                                <option value="3">3 ans</option>
                                <option value="4">4 ans</option>
                                <option value="5">5 ans</option>
                                <option value="6">6 ans</option>
                                <option value="7">7 ans</option>
                                <option value="8">8 ans</option>
                                <option value="9">9 ans</option>
                                <option value="10">10 ans</option>
                                <option value="11">11 ans</option>
                                <option value="12">12 ans</option>
                                <option value="13">13 ans</option>
                                <option value="14">14 ans</option>
                                <option value="15">15 ans</option>
                                <option value="16">16 ans</option>
                                <option value="17">17 ans</option>
                                <option value="18">18 ans</option>
                                <option value="19">19 ans</option>
                                <option value="20">20 ans</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="sexe">Sexe :</label>
                            <select id="sexe" name="sexe">
                                <option value="male">Male</option>
                                <option value="femelle">Femelle</option>
                            </select>
                        </div>
                        <input type="submit" name="send_post" class="btn btn-primary" value="Envoyer"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="scripts/tiny.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>