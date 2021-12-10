<?php /**
 * @var $post \App\Entity\Post[]
 * @var $postid int
 */ ?>
<h1>Ceci est la page d'un post</h1>
<?php if ($post->getIdUser() !== null) : ?>
<p><? echo $post->getAuthor()->getFirstname();?></p>
<p><? echo $post->getAuthor()->getLastname();?></p>
<?php endif; ?>
<p><? echo $post->getTitle();?></p>
<p><? echo $post->getContent();?></p>
<p><? echo $post->getIdPost();?></p>
<p><? echo $post->getCreationDate();?></p>


<form action="/deleted/" method="POST">
    <input type="hidden" value="<?php echo $postid ;?>" name="deleteid" />
    <input type="submit" class="btn btn-primary" value="Delete Post" name="delete" />
</form>

<form action="/updated/2/" method="POST">
    <input type="hidden" value="" name="updatedPost" />
    <p><input type="submit" class="btn btn-primary"  value="Edit Post" /></p>
</form>

<?php
?>