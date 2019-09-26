<?php

use \src\core\Controller;
use \src\core\Authm;

class Controller_auth extends Controller
{
    private $auth;

    public function __construct()
    {
        $this->auth = (new Authm())->getAuth();
        parent::__construct();
    }
    
    public function action_index()
    {
        $this->view->render('login.php');
    }

    public function action_login()
    {
        $errors = [];
        try {
            $this->auth->login($_POST['email'], $_POST['password']);
            header("Location: /");
        } catch (\Delight\Auth\InvalidEmailException $e) {
            array_push($errors, 'Wrong email address');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            array_push($errors, 'Wrong password');
        } catch (\Delight\Auth\EmailNotVerifiedException $e) {
            array_push($errors, 'Email not verified');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            array_push($errors, 'Too many requests');
        }

        $this->view->render('login.php', ['errors' => $errors]);
    }


    public function action_logout()
    {
        $this->auth->logOut();
        header("Location: /");
    }
}
