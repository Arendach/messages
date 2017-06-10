<?php

class MessagesModel extends Model
{
    public static function saveMessage($data)
    {
        $data['name'] = htmlspecialchars(trim($data['name']));
        $data['email'] = htmlspecialchars(trim($data['email']));
        $data['site'] = htmlspecialchars(trim($data['site']));
        $data['message'] = htmlspecialchars(trim($data['message']));
        $connect = DataBase::getConnection();

        $connect->query('INSERT INTO `messages` SET 
            `name` = "' . $data['name'] . '", 
            `email` = "' . $data['email'] . '",
            `site` = "' . $data['site'] . '",
            `message` = "' . $data['message'] . '",
            `ip` = "' . $_SERVER['REMOTE_ADDR'] . '",
            `browser` = "' . $data['browser'] . '",
            `date` = "' . date('Y-m-d h:i:s') . '"'
        );
    }

}