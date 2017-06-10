<?php

class View
{
    /**
    * Повертає вид з шаблоном
    */

    public static function generate($view,$data = []) {
        if(count($data) != 0) {
            foreach ($data as $k => $v)
                $$k = $v;
        }
        header("Content-type:text/html; charset=UTF-8");
        include Q_PATH.'/application/views/template.php';
    }

    /**
     * Повертає вид без шаблона
     */

    public static function getForm($form, $data = [])
    {
        if(count($data) != 0) {
            foreach ($data as $k => $v)
                $$k = $v;
        }
        header("Content-type:text/html; charset=UTF-8");
        include Q_PATH.'/application/views/'.$form.'.php';
    }

}