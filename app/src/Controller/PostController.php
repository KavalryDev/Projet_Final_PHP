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
                'posts'=> $posts,
                'post'=> new Post(),
            ],
            'Homepage'
        );
    }


    /**
     *
     */
    public function executeShow()
    {
        Flash::setFlash('alert', 'je suis une alerte');

        return $this->render(
            'post.php',
            [
                'test' => 'article ' . $this->params['id']
            ],
            'Post Page'
        );
    }
}