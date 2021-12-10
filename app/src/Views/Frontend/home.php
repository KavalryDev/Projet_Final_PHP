<h1>Un titre de home page</h1>

<?php
/**
 * @var $posts \App\Entity\Post[]
 */

var_dump($posts);

echo "Bonjour";

foreach ($posts as $post)
{
    ?>
    <article>
        <h2><?= $post['title'] ?></h2>
        <p><?= $post['creationDate'] ?></p>
        <p><?= $post['name'] ?></p>
    </article>
    <?php
}