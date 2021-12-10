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
                    exit();
                }

            case false:
                header('Location: /');
                exit();
        }
    }


    /**
     * Delete 1 Post by its Id
     */
    public function executeDeletePostById()
    {
        // TODO - Pousser un flash à la suppression du post ?

        $postid = $this->params['id'];
        $postManager = new PostManager();

        switch ($postid !="") {
            case true:
                $post = $postManager->getPostById($this->params['id']);
                if ( is_object($post) ) {
                    Flash::setFlash('alert', 'Post supprimé.');
                    //$postManager->deletePostById($postid);
                }
                header('Location: /');
                exit();

            case false:
                header('Location: /');
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