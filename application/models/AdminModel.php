<?php

class AdminModel extends Model
{
    public static function paginate()
    {
        $data = [];
        $data['items'] = 2;

        $connect = DataBase::getConnection();

        // активна сторінка
        $data['active'] = !empty($_GET['page']) ? abs(intval($_GET['page'])) : 1;

        // Всі записи в базі даних

        $query_count =  $connect->query('SELECT COUNT(*) AS `all` FROM `messages`');
        if($query_count !== false)
            $count = $query_count->fetch_assoc();
        else
            $count = 0;
        $data['all'] = $count['all'];

        $order = isset($_GET['order']) ? $_GET['order'] : 'desc';
        $by = isset($_GET['by']) ? $_GET['by'] : 'date';

        $data['url'] = '?order=' . $order . '&by=' . $by;
        $data['url_page'] = '?order=' . $order . '&by=' . $by . '&page=';

        return $data;
    }

    public static function getMessages()
    {
        // Зєднання з базою даних
        $connect = DataBase::getConnection();

        /** Перемінні пагінатора */

        /** @default desc */
        $order = isset($_GET['order']) ? $_GET['order'] : 'desc';

        /** @default date */
        $by = isset($_GET['by']) ? $_GET['by'] : 'date';

        // активна сторінка
        $active = !empty($_GET['page']) ? abs(intval($_GET['page'])) : 1;

        // К-сть елементів на сторінці
        $items = 2;

        // Старт вибірки
        $start = ($active - 1) * $items;

        $query_count =  $connect->query('SELECT COUNT(*) AS `all` FROM `messages`');
        if($query_count !== false)
            $count = $query_count->fetch_assoc();
        else
            $count = 0;

        if ($count['all'] > 0) {
            $query = $connect->query('SELECT * FROM `messages` ORDER BY `' . $by . '` ' . $order . ' LIMIT ' . $start . ', ' . $items);
            $i = 0;
            while($row = $query->fetch_assoc()){
                $data[$i] = $row;
                $i++;
            }
            return $data;
        } else {
            return false;
        }

    }

    public static function getMessage($id)
    {
        $connect = DataBase::getConnection();
        $query = $connect->query('SELECT * FROM `messages` WHERE `id` = ' . $id . ' LIMIT 1');
        if($query->num_rows == 1)
            return $query->fetch_assoc();
    }

    public static function deleteMessage($id)
    {
        $connect = DataBase::getConnection();
        $res = $connect->query('DELETE FROM `messages` WHERE `id` = ' . $id);
        return $res ? true : false;
    }

    public static function saveChanges($data)
    {
        $connect = DataBase::getConnection();
        $res = $connect->query('UPDATE `messages` SET 
            `name` = "' . $data['name'] . '", 
            `email` = "' . $data['email'] . '", 
            `site` = "' . $data['site'] . '", 
            `message` = "' . $data['message'] . '"
            WHERE `id` = "' .$data['id'] . '"'
        );
        echo $res ? json_encode(['status' => '1']) : json_encode(['status' => '0']);

    }

}