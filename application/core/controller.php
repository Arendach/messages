<?php

class Controller {
    public $js;
    public $css;
    public $config;

    public function getConfig()
    {
        $this->config = parse_ini_file(Q_PATH . '/application/core/config.ini');
    }
 }