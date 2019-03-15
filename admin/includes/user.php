<?php

class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username','password','first_name','last_name','user_image');
    protected static $id_field = "id";

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $upload_directory = "images";
    public $placeholder_img = "http://placehold.it/400x400&text=image";

    public $tmp_path;

    public function image_path() {
        return empty($this->user_image) ? $this->placeholder_img : $this->upload_directory.DS.$this->user_image;
    }
    
    public static function verify_user($username,$password) {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

    $sql = "SELECT * FROM ". self::$db_table ." WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

    $result_array = self::find_by_query($sql);
        
    return !empty($result_array) ? array_shift($result_array) : false;

    }

    public function set_files($file) {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "No file was uploaded";
            return false;
        }
        else if ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } 
        else {
            $this->tmp_path = $file['tmp_name'];
            $this->user_image = basename($file['name']);
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    public function upload_image() {
        if (!empty($this->errors)) {
            return false;
        }

        if (empty($this->user_image) || empty($this->tmp_path)) {
            $this->errors[] = "The file was not available.";
            return false;
        }

        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

        if (file_exists($target_path)) {
            $this->errors[] = "The file {$this->user_image} already existed.";
            return false;
        }

        if (move_uploaded_file($this->tmp_path,$target_path)) {
            unset($this->tmp_path);
            return true;
        }
        else {
            $this->errors[] = "The file directory probably does not have permission";
            return false;
        }
    }

    public function delete_photo() {
        $target_path = SITE_ROOT .DS. "admin" .DS. $this->image_path();
        return unlink($target_path) ? true : false;
    }

}

?>