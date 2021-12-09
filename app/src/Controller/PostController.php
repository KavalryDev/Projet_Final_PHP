<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Fram\Factories\PDOFactory;
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
        $allPost = $postManager->getAllPosts();

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
                    echo "nop";
                }
                break;

            case false:
                header('Location: /');
                exit();
                break;
        }
    }
}