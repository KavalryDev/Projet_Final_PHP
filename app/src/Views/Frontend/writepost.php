<h1>Ceci est la page de création d'un post</h1>

<form method="POST" action="/created/" enctype="multipart/form-data">
    <label>Titre : <input type="text" name="Title" /></label><br />
    <label>Message : <br />
        <textarea name="Content" cols="50" rows="10"></textarea></label><br />

    <input type="submit" value="Envoyer" />
    <input type="reset" value="Rétablir" />
</form>