<?php $title = "Administration des posts" ?>
<?php ob_start(); ?>

<section class="container rounded bg-secondary mt-3 pt-1 pb-3">
<?php 
    $postManager = new \App\Models\PostManager();
    $pagiPost = $postManager->paginationPost();
    $numberPost = $pagiPost['total'];
    $messagePerPage = 5;
    $totalPages = ceil($numberPost / $messagePerPage);

    if(isset($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $totalPages) {
        $pageActive = intval($_GET['page']);
    }
    else {
        $pageActive = 1;
    }

    $firstMessage = ($pageActive-1) * $messagePerPage; 

    $posts = $postManager->getPosts($firstMessage,$messagePerPage);
    foreach ($posts as $data) 
    {
        ?>
        <article class="container bg-light mt-3 pb-2">
            <h2 class="text-center"><?= $data['title'];?></h2>
            <p class="text-center">posté le <?= $data['creation_date_fr'];?></p>
            <p><?= substr(nl2br($data['post']),0,400);?></p>
            <div class="text-center">
                <a href="https://projetsls.fr/SPA-Chamalieres/Modification-Post-<?= $data['id']; ?>" title="Modifier le post" class="btn btn-primary"><i class="far fa-edit"></i></a>
                <a href="https://projetsls.fr/SPA-Chamalieres/Suppression-Post-<?= $data['id']; ?>" title="Supprimer le post" class="btn btn-primary" data-toggle="modal" data-target="#modal_<?= $data['id'];?>"><i class="far fa-trash-alt"></i></a>
            </div>
            <div class="modal fade" id="modal_<?= $data['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alerte</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Voulez-vous vraiment supprimer ce post?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <a href="https://projetsls.fr/SPA-Chamalieres/Suppression-Post-<?= $data['id']; ?>" class="btn btn-primary" >Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
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
                echo ' <a href="https://projetsls.fr/SPA-Chamalieres/Administration-Post/Page-'.$i.'">'.$i.'</a> ';
            }
        }
        echo '</p>';
    ?>
</section>

<script src="scripts/tiny.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>