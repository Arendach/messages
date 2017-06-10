<?php

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->js = [
            '/public/js/jquery.js',
            '/public/js/bootstrap.js',
            '/public/js/validator.js',
            '/public/js/custom.js',
            '//cdn.ckeditor.com/4.7.0/full/ckeditor.js',
            '/public/js/create.js',
        ];
        $this->css = [
            '/public/css/bootstrap.css',
            '/public/css/style.css'
        ];
    }

    public function CreateAction()
    {
        $data = [
            'css' => $this->css,
            'js' => $this->js,
            'title' => 'Створити замітку!',
            'captcha' => '<img src="/messages/getCaptcha">'
        ];
        View::generate('create', $data);
    }

    public function PostCreateAction()
    {
        $data = $_POST;
        $err = 0;
        if (!isset($data['name']) || isset($data['name']) && empty($data['name']))
            $err++;
        if (!isset($data['email']) || isset($data['email']) && empty($data['email']))
            $err++;
        if (!isset($data['message']) || isset($data['message']) && empty($data['message']))
            $err++;
        if (!isset($data['captcha']) || isset($data['captcha']) && $data['captcha'] != $_SESSION['captcha'])
            $err++;

        if ($err == 0) {
            $user_agent = $_SERVER["HTTP_USER_AGENT"];
            if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
            elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
            elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
            elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
            elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
            else $browser = "Невідомий";
            $data['browser'] = $browser;
            MessagesModel::saveMessage($data);
            echo json_encode(['status' => '1']);
        } else {
            echo json_encode(['status' => '0']);
        }
    }

    public function checkCaptchaAction()
    {
        if ($_POST['captcha'] == $_SESSION['captcha']) {
            echo json_encode(['status' => '1']);
        } else {
            echo json_encode(['status' => '0']);
        }
    }

    public function CAction()
    {
        echo $_SESSION['captcha'];
    }

    public function GetCaptchaAction()
    {
        $EasyCaptcha = new EasyCaptcha();
        $EasyCaptcha->EasyCaptcha();
    }
}