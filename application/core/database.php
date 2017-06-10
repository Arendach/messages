<?php

class DataBase
{
    public static function getConnection()
    {
        $config = parse_ini_file(Q_PATH . '/application/core/config.ini');
        $mysqli = new mysqli($config['DB_HOST'], $config['DB_USER'], $config['DB_PASSWORD'], $config['DB_NAME']);

        if ($mysqli->connect_error) {
            $err = die('Помилка підключення (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        } else {
            return $mysqli;
        }
    }
}

?>