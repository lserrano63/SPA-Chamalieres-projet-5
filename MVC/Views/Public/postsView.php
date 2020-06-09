<?php $title = "Actualités"; ?>
<?php ob_start(); ?>

<section class="container rounded bg-secondary pt-3 pb-1">
    <?php 
        $postManager = new \App\Models\PostManager();
        $pagiPost = $postManager->paginationPost();

        $numberPosts = $pagiPost['total'];
        $messagePerPage = 2;
        $totalPages = ceil($numberPosts / $messagePerPage);

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
            <article class="container bg-light">
                <h2 class="text-center"><?= $data['title'];?></h2>
                <p class="text-center">posté le <?= $data['creation_date_fr'];?></p>
                <p><?= substr(nl2br($data['post']),0,300);?> ...<br>
                <a class="btn btn-primary mb-1" href="?action=viewPost&id=<?= $data['id']; ?>">Voir plus</a></p>    
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
                echo ' <a href="index.php?action=viewPosts&page='.$i.'">'.$i.'</a> ';
            }
        }
        echo '</p>';
?>   
</section>

<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>