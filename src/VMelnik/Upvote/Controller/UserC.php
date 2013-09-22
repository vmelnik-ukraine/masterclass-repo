<?php

namespace VMelnik\Upvote\Controller;

use VMelnik\Framework\Controller\BaseC;

class UserC extends BaseC
{

    public function create()
    {
        $error = null;

        // Do the create
        if (isset($_POST['create'])) {
            if (empty($_POST['username']) || empty($_POST['email']) ||
                    empty($_POST['password']) || empty($_POST['password_check'])) {
                $error = 'You did not fill in all required fields.';
            }

            if (is_null($error)) {
                if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
                    $error = 'Your email address is invalid';
                }
            }

            if (is_null($error)) {
                if ($_POST['password'] != $_POST['password_check']) {
                    $error = "Your passwords didn't match.";
                }
            }

            if (is_null($error)) {

                $userModel = $this->get('user.m');

                if ($userModel->isUserExists($_POST['username'])) {
                    $error = 'Your chosen username already exists. Please choose another.';
                } else {
                    $userModel->createUser($_POST['username'], $_POST['email'], $_POST['password']);
                    header("Location: /user/login");
                    exit;
                }
            }
        }

        ob_start();
        include __DIR__ . '/../View/User/create.phtml';
        $content = ob_get_contents();
        ob_end_clean();

        require_once __DIR__ . '/../View/layout.phtml';
    }

    public function account()
    {
        $error = null;
        if (!isset($_SESSION['AUTHENTICATED'])) {
            header("Location: /user/login");
            exit;
        }

        $userModel = $this->get('user.m');

        if (isset($_POST['updatepw'])) {
            if (!isset($_POST['password']) || !isset($_POST['password_check']) ||
                    $_POST['password'] != $_POST['password_check']) {
                $error = 'The password fields were blank or they did not match. Please try again.';
            } else {
                $userModel->changePassword($_SESSION['username'], $_POST['password']);
                $error = 'Your password was changed.';
            }
        }

        $user = $userModel->getUser($_SESSION['username']);

        ob_start();
        include __DIR__ . '/../View/User/account.phtml';
        $content = ob_get_contents();
        ob_end_clean();

        require_once __DIR__ . '/../View/layout.phtml';
    }

    public function login()
    {
        $error = null;
        // Do the login
        if (isset($_POST['login'])) {
            $username = $_POST['user'];
            $password = $_POST['pass'];
            if ($this->get('user.m')->authUser($username, $password)) {
                header("Location: /");
                exit;
            } else {
                $error = 'Your username/password did not match.';
            }
        }

        ob_start();
        include __DIR__ . '/../View/User/login.phtml';
        $content = ob_get_contents();
        ob_end_clean();

        require_once __DIR__ . '/../View/layout.phtml';
    }

    public function logout()
    {
        // Log out, redirect
        session_destroy();
        header("Location: /");
    }

}