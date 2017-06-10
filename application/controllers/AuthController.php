<?php

class AuthController extends Controller
{
    public function __construct()
    {
        parent::getConfig();
    }

    public function IndexAction()
    {
        if ($_POST['login'] == $this->config['LOGIN'] && $_POST['password'] == $this->config['PASSWORD']) {
            $_SESSION['login'] = $this->config['LOGIN'];
            $_SESSION['password'] = $this->config['PASSWORD'];
            echo json_encode(['status' => '1']);
        } else {
            echo json_encode(['status' => '0']);
        }
    }
}