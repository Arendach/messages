<?php

class Route
{

    public static function Start()
    {
        $controller_name = 'index';
        $action_name = 'index';

        $route_array = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($route_array[1])) {
            $controller_name = $route_array[1];
        }

        if (!empty($route_array[2])) {
            $action = $route_array[2];
            $request = explode('?', $action);
            $action_name = $request[0];
            $get_parameters = $request[1];
            $get_parameters_array = explode('&', $get_parameters);

            foreach ($get_parameters_array as $get_parameter_one) {
                $explode_get_parameter_one = explode('=', $get_parameter_one);
                $parameter[$explode_get_parameter_one[0]] = $explode_get_parameter_one[1];
            }
        }

        $model_name = ucfirst($controller_name) . 'Model';
        $controller_name = ucfirst($controller_name) . 'Controller';
        $action_name = ucfirst($action_name) . 'Action';

        if (file_exists(Q_PATH . '/application/models/' . $model_name . '.php')) {
            include Q_PATH . '/application/models/' . $model_name . '.php';
        }

        if (file_exists(Q_PATH . '/application/controllers/' . $controller_name . '.php')) {
            include Q_PATH . '/application/controllers/' . $controller_name . '.php';
        } else {
            header('Location: /err404');
            exit;
        }

        $controller = new $controller_name();
        if (method_exists($controller, $action_name)) {
            $controller->$action_name($parameter);
        } else {
            header('Location: /err404');
            exit;
        }

    }

}
