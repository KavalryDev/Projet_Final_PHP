<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Comment;
use App\Fram\Factories\PDOFactory;
use App\Fram\Utils\Flash;
use App\Manager\CommentManager;
use DateTime;

class CommentController extends BaseController
{
    /**
     * Show all posts
     */

    public function executeIndex()
    {
        $commentManager = new commentManager(PDOFactory::getMysqlConnection());
        $comments = $commentManager->getAllComments();

        $this->render(
            'home.php',
            [
                'comments'=> $comments,

            ],
            'Homepage'
        );
    }

    /**
     *
     */
    public function executeShowComment()
    {
        $commentid = $this->params['id']; // -> $_GE
        $commentManager = new CommentManager(PDOFactory::getMysqlConnection());

        switch ($commentid !="") {
            case true:
                $comment = $commentManager->getCommentById($this->params['id']);
                if (is_object($comment['Comment'])) {
                    return $this->render(
                        'comment.php',
                        [
                            'comment' => $comment['Comment'],
                            'commentid' => $commentid,
                            'user' => $comment['User']
                        ],
                        'Comment Page'
                    );
                } else {
                    header('Location: /');
                    Flash::setFlash('alert', 'This comment doesn\'t exist.');
                    exit();
                }
            case false:
                header('Location: /');
                Flash::setFlash('alert', 'You don\'t have access');
                exit();
        }
    }


    /**
     * Delete 1 Comment by its Id
     */
public function executeDeleteCommentById()
    {
        if ( $_SERVER['REQUEST_METHOD'] == 'POST'){

            $commentid = $_POST['deleteid'];
            $commentManager = new CommentManager(PDOFactory::getMysqlConnection());

            switch ($commentid != "") {
                case true:
                    $comment = $commentManager->getCommentById($_POST['deleteid']);
                    if (is_object($comment['Post'])){
                        Flash::setFlash('success', 'The comment has been deleted.');
                    } else {
                        Flash::setFlash('alert', 'The comment you\'re trying to delete doesn\' exist.');
                    }
                    header('Location:/');
                    exit();

                case false:
                    header('Location: /');
                    Flash::setFlash('alert', 'The comment you\'re trying to delete doesn\'t exist.');
                    exit();
            }

        }else{
            header('Location: /');
            Flash::setFlash('alert', 'You don\'t have access for this command.');
            exit();
        }
    }

    public function executeCreateComment()
    {
        var_dump($_POST);
        $comment = new Comment($_POST);
        $comment->setCreationDate(date('Y-m-d H:i:s',(new DateTime)->getTimeStamp()));
        $commentManager = new CommentManager(PDOFactory::getMysqlConnection());
        $commentManager->createComment($comment);
        Flash::setFlash('success', 'This Comment has been created');

    }

    public function executeUpdateCommentById()
    {
        $comment = new Comment($this->params);
        $commentManager = new CommentManager(PDOFactory::getMysqlConnection());
        $commentManager->updateCommentById($comment);

        Flash::setFlash('success', 'This Comment has been updated.');
        // display the freshly updated comment
        return $this->render(
            'comment.php',
            [
                'comment' => $comment
            ],
            'Comment page'
        );
    }
}