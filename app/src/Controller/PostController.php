<?php

namespace App\Controller;

use App\Entity\Post;
use App\Fram\Factories\PDOFactory;
use App\Fram\Utils\Flash;
use App\Manager\PostManager;
use DateTime;


class PostController extends BaseController
{

    /**
     * Show all posts
     */
    public function executeIndex()
    {
        $postManager = new PostManager(PDOFactory::getMysqlConnection());
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
        $postManager = new PostManager(PDOFactory::getMysqlConnection());

        switch ($postid !="") {
            case true:
                $post = $postManager->getPostById($this->params['id']);
                if ( is_object($post) ) {
                    return $this->render(
                        'post.php',
                        [
                            'post' => $post,
                            'postid' => $postid,
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
            $postManager = new PostManager(PDOFactory::getMysqlConnection());

            switch ($postid != "") {
                case true:
                    $post = $postManager->getPostById($_POST['deleteid']);
                    if (is_object($post)) {
                        Flash::setFlash('success', 'The post has been deleted.');
                        $postManager->deletePostById($postid);
                    } else {
                        Flash::setFlash('alert', 'The post you\'re trying to delete doesn\'t exist.');
                    }
                    header('Location: /');
                    exit();

                case false:
                    header('Location: /');
                    Flash::setFlash('alert', 'The post you\'re trying to delete doesn\'t exist.');
                    exit();
            }

        } else {
            header('Location: /');
            Flash::setFlash('alert', 'You don\'t have access for this command.');
            exit();
        }
    }


    /**
     * Create 1 Post via Form
     */
    public function executeCreatePost()
    {
        return $this->render(
            'writepost.php',
            [
            ],
            'New Post'
        );
    }


    /**
     * Create 1 Post via Form
     */
    public function executeCreatedPost()
    {
        $post = new Post($_POST);
        $post->setCreationDate(date('Y-m-d H:i:s',(new DateTime)->getTimeStamp()));
        $postManager = new PostManager(PDOFactory::getMysqlConnection());
        $postManager->createPost($post);

        Flash::setFlash('success', 'This Post has been created.');
        // display the freshly created post
        header('Location: /');
    }


    /**
     * Update 1 Post via Form
     */
    public function executeUpdatePostById()
    {
        // TODO - Checker le fonctionnement via formulaire
        // TODO - Impossible de checker en l'état car je ne peux pas passer le contenu d'un Post dans $_GET
        $post = new Post($this->params);
        $postManager = new PostManager(PDOFactory::getMysqlConnection());
        $postManager->updatePostById($post);


        Flash::setFlash('success', 'This Post has been updated.');
        // display the freshly updated post
        return $this->render(
            'post.php',
            [
                'post' => $post,
            ],
            'Post Page'
        );
    }
}