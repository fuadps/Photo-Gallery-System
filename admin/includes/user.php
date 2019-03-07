<?php

class User {

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    
    public static function find_all_users() {
        $result_set = self::find_query("SELECT * FROM users");
        return $result_set;
    }

    public static function find_user_by_id($user_id) {
        $result = self::find_query("SELECT * FROM users WHERE id =" . $user_id);
        $found_user = mysqli_fetch_array($result);

        return $found_user;
    }

    public static function find_query($sql) {
        global $database;

        $result_set = $database->query($sql);
        return $result_set;
    }
}

?>