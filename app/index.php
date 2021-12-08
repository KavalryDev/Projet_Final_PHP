<?php
session_start();
require './vendor/autoload.php';

/*$router = new \App\Fram\Router();
$router->getController();*/
echo "bonjour <br />";

//$userLists = (new \App\Manager\UserManager( \App\Fram\Factories\PDOFactory::getMysqlConnection() ))->getAllUsers();

//var_dump($userLists);

//$user = ['firstname' => 'Michel','lastname' => 'Polnaref','password' => '6789','email' => 'michou@music.fr','isAdmin' => true];
//$michel = new \App\Entity\User($user);

//(new \App\Manager\UserManager)->createUser($michel);

//var_dump((new \App\Manager\UserManager())->getUserById(1)->getFirstname());

//$michelUpdate = (new \App\Manager\UserManager())->getUserById(5);
//$michelUpdate->setLastname('Poulenaref');

//(new \App\Manager\UserManager())->updateUserById($michelUpdate);

/*(new \App\Manager\UserManager())->deleteUserById(6);

$Manager = new \App\Manager\UserManager();

$Manager->deleteUserById();*/

$postCreation = new \App\Manager\PostManager();
$post = ['title' => 'Le super Michou', 'content' => 'Il est vraiment super ce Michou', 'creationDate' => new DateTime()];
$newpost = new \App\Entity\Post($post);
echo $newpost->getTitle();
echo '<br>';

$postCreation->createPost($newpost);