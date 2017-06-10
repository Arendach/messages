<?php

class AdminController extends Controller
{
    public function __construct()
    {
        parent::getConfig();

        $this->js = [
            '/public/js/jquery.js',
            '/public/js/bootstrap.js',
            '/public/js/validator.js',
            '/public/js/custom.js',
            '/public/js/admin.js'
        ];
        $this->css = [
            '/public/css/bootstrap.css',
            '/public/css/style.css'
        ];

        if ($_SESSION['password'] != $this->config['PASSWORD'] || $_SESSION['login'] != $this->config['LOGIN']) {
            $data = [
                'css' => $this->css,
                'js' => $this->js,
                'title' => 'Авторизація!'
            ];
            View::generate('admin/login', $data);
            exit;
        }
    }

    /**
     * Функція повертає вид авторизації або адмін панелі
     */

    public function IndexAction()
    {
        if (isset($_SESSION['login']) && isset($_SESSION['password']) && $_SESSION['login'] == 'admin' && $_SESSION['password'] == '123') {
            $data = [
                'css' => $this->css,
                'js' => $this->js,
                'title' => 'Адмін панель!'
            ];
            View::generate('admin/index', $data);
        } else {
            $data = [
                'css' => $this->css,
                'js' => $this->js,
                'title' => 'Авторизація!'
            ];
            View::generate('admin/login', $data);
        }
    }

    /**
     * Функція повертає вид нагадування паролю
     */

    public function ForgotPasswordAction()
    {
        $data = [
            'css' => $this->css,
            'js' => $this->js,
            'title' => 'Згадати пароль!'
        ];
        View::generate('admin/forgot_password', $data);
    }


    public function MessagesAction()
    {
        $data = [
            'css' => $this->css,
            'js' => $this->js,
            'title' => 'Менеджер заміток!',
            'messages' => AdminModel::getMessages(),
            'paginate' => AdminModel::paginate()
        ];
        View::generate('admin/messages', $data);
    }

    public function MessageDeleteAction()
    {
        echo AdminModel::deleteMessage($_POST['id']) ? json_encode(['status' => '1']) : json_encode(['status' => '0']);
    }

    public function GetEditFormAction()
    {
        View::getForm('modals/admin/edit_message', ['message' => AdminModel::getMessage($_POST['id'])]);
    }

    public function SaveChangesAction()
    {
        $data = $_POST;
        $data['name'] = htmlspecialchars(trim($data['name']));
        $data['email'] = htmlspecialchars(trim($data['email']));
        $data['site'] = htmlspecialchars(trim($data['site']));
        $data['message'] = htmlspecialchars(trim($data['message']));
        AdminModel::saveChanges($data);
    }
}
