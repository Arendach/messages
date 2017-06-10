<?php

class Err404Controller extends Controller {

    public function __construct()
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
            'title' => 'Сторінка не знайдена'
        ];
        View::generate('404',$data);
    }

}