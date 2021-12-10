<?php
/**
 * @var $post \App\Entity\Post[]
 */ ?>
<h1>Ceci est la page d'un post</h1>

<p><? //echo $post->getUserById('name');?></p>
<p><? echo $post->getTitle();?></p>
<p><? echo $post->getContent();?></p>
<p><? echo $post->getId();?></p>
<p><? echo $post->getCreationDate();?></p>


<form action="/deleted/" method="POST">
    <input type="hidden" value="<?php echo $postid ;?>" name="deleteid" />
    <input type="submit" value="Delete Post" name="delete" />
</form>

<form action="/updated/2/" method="POST">

    <input type="hidden" value="" name="updatedPost" />
    <p><input type="submit" value="Edit Post" /></p>
</form>


    <form action="/created/2/" method="POST">
        <input type="hidden" value="" name="createdPost" />
        <p><input type="submit" value="Created Post" /></p>
    </form>

<?php
var_dump($post);
echo "<br><br><br>";
echo "je suis postid ";
var_dump($postid);
?>