<?php

namespace App\Controller;

    use App\Entity\User;
    use App\Entity\Comment;
    use App\Fram\Factories\PDOFactory;
    use App\Fram\Utils\Flash;
    use App\Manager\CommentManager;

class CommentController extends BaseController
{
    /**
     * Show all posts
     */

    public function executeIndex()
    {
        $commentManager = new CommentManager(PDOFactory::getMysqlConnection());
        $comments = $commentManager->getAllComments();

        $this->render(
            'home.php',
            [
                'comments'=> $comments,
                'comment'=> new Comment(),
            ],
            'Home page'
        );
    }
    public function executeShow()
    {
        Flash::setFlash('alert', 'je suis une alerte');

        $this->render(
            'show.php',
            [
                'test' => 'article ' . $this->params['id']
            ],
            'Show Page'
        );
    }
}