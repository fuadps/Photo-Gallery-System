<?php 

class Admin extends Db_object {

    protected static $db_table = "admin";
    protected static $db_table_fields = array('id','username','password');
    protected static $id_field = "id";

    public $id;
    public $username;
    public $password;

    public static function verify_admin($username,$password) {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

    $sql = "SELECT * FROM ". self::$db_table ." WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

    $result_array = self::find_by_query($sql);
        
    return !empty($result_array) ? array_shift($result_array) : false;

    }
}

?>