<h1>Un titre de home page</h1>

<?php
/**
 * @var $posts \App\Entity\Post[]
 */
use App\Entity\Post;

foreach ($posts as $post) : ?>

    <br>
    <article>
        <h2><? echo '<a href="./post/'.$post['idPost'].'"' ;?>><? echo $post['Title'];?></a></h2>
        <p><? echo $post['Content'];?></p>
        <?php if (isset($post['idUser'])) : ?>
        <p>Auteur : <? echo (new Post($post))->getAuthor()->getFirstname();?> <? echo (new Post($post))->getAuthor()->getLastname();?></p>
        <?php endif; ?>
        <span><? echo $post['CreationDate'];?></span>
    </article>

    <form action="/deleted/" method="POST">
        <input type="hidden" value="<?php echo $post['idPost'] ;?>" name="deleteid" />
        <input type="submit" class="btn btn-primary" value="Delete Post" name="delete" />
    </form>

    <form action="/updated/" method="POST">

        <input type="hidden" value="" name="updatedPost" />
        <p><input type="submit" class="btn btn-primary" value="Edit Post" /></p>
    </form>
    <br>
<?php endforeach; ?>
