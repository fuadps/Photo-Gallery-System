<?php

class Db_object {

    public static function find_all() {
        $result_set = static::find_by_query("SELECT * FROM ". static::$db_table ." ");
        return $result_set;
    }

    public static function find_by_id($user_id) {
        global $database;
        $result_array = static::find_by_query("SELECT * FROM ". static::$db_table ." WHERE id =" .$user_id. " LIMIT 1");
        
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_query($sql) {
        global $database;

        $result_set = $database->query($sql);
        $the_object_array = array();

        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }

        return $the_object_array;
    }

    public static function instantiation($the_record) {

        $calling_class = get_called_class();
        $the_object = new $calling_class;

        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }

    private function has_the_attribute($the_attribute) {
        $the_object = get_object_vars($this);

        return array_key_exists($the_attribute,$the_object);
    }

    protected function get_properties() {
        global $database;
        $properties = array();
        
        foreach (static::$db_table_fields as $db_field) {
            if(property_exists($this,$db_field)) {
                $properties[$db_field] = $database->escape_string($this->$db_field);
            }
        }

        return $properties;
        //return get_object_vars($this);
    }

    public function create() {
        global $database;
        $properties = $this->get_properties();

        $sql = "INSERT INTO ". static::$db_table ." (". implode(",",array_keys($properties)).")
                VALUES('". implode("','",array_values($properties)) ."')";

        echo $sql;
        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        }
        else {
            return false;
        }
    }

    public function update() {
        global $database;
        $properties = $this->get_properties();

        $properties_pair = array();

        foreach ($properties as $key => $value) {
            $properties_pair[] = "{$key} = '{$value}'";
        }
        
        $sql = "UPDATE ". static::$db_table ." SET ".
                    implode(",", $properties_pair). " 
                    WHERE id = {$this->id}";

        $database->query($sql);

        return mysqli_affected_rows($database->connection) == 1 ? true : false;
    }

    public function delete() {
        global $database;

        $sql = "DELETE FROM ". static::$db_table ." WHERE id = {$database->escape_string($this->id)} LIMIT 1";

        $database->query($sql);
        
        return mysqli_affected_rows($database->connection) == 1 ? true : false;
    }

    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }
}

?>