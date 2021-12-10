<?php

namespace App\Controller;

    use App\Entity\Post;
    use App\Entity\User;
    use App\Fram\Factories\PDOFactory;
    use App\Fram\Utils\Flash;
    use App\Manager\UserManager;

class UserController extends BaseController
{
    /**
     * Show all posts
     */

    public function executeIndex()
    {
        $userManager = new UserManager(PDOFactory::getMysqlConnection());
        $users = $userManager->getAllUsers();

        $this->render(
            'home.php',
            [
                'post'=> $users,
                'post'=> new Post(),
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

    public function executeLogin()
    {
        $this->render(
            'login.php',
            [
            ],
            'Login Page'
        );
    }


    public function executeLoginAction()
    {

        header('Location: /');
    }
}