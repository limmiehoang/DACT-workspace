<?php

class Login extends Controller
{
    function __construct() {
        parent::__construct();
    }
    function index() {
        if ($this->isAuthenticated()) {
            $this->redirect('/product');
        }
        $response = $this->display_messages();
        $this->view->render('login', $response);
    }
    function doLogin() {
        global $session;

        require 'models/UserModel.php';
        $model = new UserModel();

        $inputUsername = $this->request()->get('username');

        $user = $model->findUserByUsername($inputUsername);
        if (empty($user)) {
            $session->getFlashBag()->add('error', 'Wrong username or password!');
            $this->redirect('/login');
        }

        $inputPassword = $this->request()->get('password');

        if (!password_verify($inputPassword, $user['password'])) {
            $session->getFlashBag()->add('error', 'Wrong username or password!');
            $this->redirect('/login');
        }

        $session->set('username', $user['username']);
        $expTime = time() + 3600; // 1 hour
        $jwt = \Firebase\JWT\JWT::encode([
                'iss' => $this->request()->getBaseUrl(),
                'sub' => "{$user['id']}",
                'exp' => $expTime,
                'iat' => time(),
                'nbf' => time(),
                'role' => "{$user['role_id']}",
                'group' => "{$user['group_id']}",
                ], getenv("SECRET_KEY"), 'HS256');

        $accessToken = new Symfony\Component\HttpFoundation\Cookie('access_token', $jwt, $expTime, '/', getenv('COOKIE_DOMAIN'));
        $session->getFlashBag()->add('success', 'You have just logged in.');
        $this->redirect('/product', ['cookies' => [$accessToken]]);
    }
}