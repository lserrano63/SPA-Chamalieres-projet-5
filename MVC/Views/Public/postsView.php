<?php $title = "Actualités"; ?>
<?php ob_start(); ?>

<section id="posts" class="pt-2 pb-4">
    <div class="container rounded bg-secondary pt-3 pb-1">
        <?php
            foreach ($posts as $data) 
            {
                ?>
                <article class="container bg-light">
                    <h2 class="text-center"><?= $data['title'];?></h2>
                    <p class="text-center">posté le <?= $data['creation_date_fr'];?></p>
                    <p><?= substr($data['post'],0,300);?> ...
                    <p><a class="btn btn-primary mb-1" href="https://projetsls.fr/SPA-Chamalieres/Posts/Post-<?= $data['id']; ?>">Voir plus</a></p>    
                </article>
                <?php
            }
            echo '<p>Page : '; 
            for($i=1; $i<=$totalPages; $i++)
            {
                if($i==$pageActive)
                {
                    echo ' [ '.$i.' ] '; 
                }    
                else
                {
                    echo ' <a href="https://projetsls.fr/SPA-Chamalieres/Actualités/Page-'.$i.'">'.$i.'</a> ';
                }
            }
            echo '</p>';
    ?>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>