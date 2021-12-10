<?php

namespace App\Controller;

use App\Entity\Post;
use App\Fram\Utils\Flash;
use App\Manager\PostManager;

class PostController extends BaseController
{

    /**
     * Show all posts
     */
    public function executeIndex()
    {
        $postManager = new PostManager(); // TODO - check la bonne pratique du PDOFactory dans BaseManager
        $posts = $postManager->getAllPosts();

        return $this->render(
            'home.php',
            [
                'posts'=> $posts
            ],
            'Homepage'
        );
    }


    /**
     * Show 1 post by its Id
     */
    public function executeShowPost()
    {

        $postid = $this->params['id']; // -> $_GET['id']
        $postManager = new PostManager();

        switch ($postid !="") {
            case true:
                $post = $postManager->getPostById($this->params['id']);
                if ( is_object($post) ) {
                    return $this->render(
                        'post.php',
                        [
                            'post' => $post,
                            'postid' => $postid
                        ],
                        'Post Page'
                    );
                } else {
                    header('Location: /');
                    Flash::setFlash('alert', 'Ce post n\'existe pas.');
                    exit();
                }

            case false:
                header('Location: /');
                Flash::setFlash('alert', 'Vous ne pouvez pas accéder à cette page.');
                exit();
        }
    }


    /**
     * Delete 1 Post by its Id
     */
    public function executeDeletePostById()
    {
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

            $postid = $_POST['deleteid'];
            $postManager = new PostManager();

            switch ($postid != "") {
                case true:
                    $post = $postManager->getPostById($_POST['deleteid']);
                    if (is_object($post)) {
                        Flash::setFlash('success', 'Post supprimé.');
                        $postManager->deletePostById($postid);
                    } else {
                        Flash::setFlash('alert', 'Le post que vous souhaitez supprimer, n\'existe pas smfdlk.');
                    }
                    header('Location: /');
                    exit();

                case false:
                    header('Location: /');
                    Flash::setFlash('alert', 'Le post que vous souhaitez supprimer, n\'existe pas lkmn.');
                    exit();
            }

        } else {
            header('Location: /');
            Flash::setFlash('alert', 'Vous ne pouvez pas accéder à cette page.');
            exit();
        }
    }


    /**
     * Create 1 Post via Form
     */
    public function executeCreatePost()
    {
        // TODO - Checker le fonctionnement via formulaire
        // TODO - Impossible de checker en l'état car je ne peux pas passer le contenu d'un Post dans $_GET
        // Remplacer $_GET (-> bannir) par $_POST
        // Je dois donner le contenu qui permettra d'instancier un objet Post.

        $post = new Post($this->params);
        $postManager = new PostManager();
        //$postManager->createPost($post);

        Flash::setFlash('success', 'Post créé.');
        // display the freshly created post
        return $this->render(
            'post.php',
            [
                'post' => $post
            ],
            'Post Page'
        );
    }


    /**
     * Update 1 Post via Form
     */
    public function executeUpdatePostById()
    {
        // TODO - Checker le fonctionnement via formulaire
        // TODO - Impossible de checker en l'état car je ne peux pas passer le contenu d'un Post dans $_GET
        $post = new Post($this->params);
        $postManager = new PostManager();
        $postManager->updatePostById($post);


        Flash::setFlash('success', 'Post mis à jour.');
        // display the freshly updated post
        return $this->render(
            'post.php',
            [
                'post' => $post
            ],
            'Post Page'
        );
    }
}