<?php

class IndexController extends Controller {

    public function __construct ()
    {
        $this->js = [
            '/public/js/jquery.js',
            '/public/js/bootstrap.js',
        ];
        $this->css = [
            '/public/css/bootstrap.css',
            '/public/css/style.css'
        ];
    }
    public function IndexAction() {
        $data = [
            'js' => $this->js,
            'css' => $this->css,
            'title' => 'Книга скарг та побажань'
        ];

        View::generate('index', $data);
    }
    public function GetCaptcha()
    {
        echo json_encode(['captcha' => $_SESSION['captcha']]);
    }
}