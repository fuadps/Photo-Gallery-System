<?php 

class Photo extends Db_object {

    protected static $db_table = "photos";
    protected static $db_table_fields = array('photo_id','title','description','filename','type','size');

    public $photo_id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;

    public $tmp_path;
    public $upload_directory = "images";
    public $errors = array();
    public $upload_errors_array = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );

    public function picture_path() {
        return $this->upload_directory .DS. $this->filename;
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
            $this->filename = basename($file['name']);
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    public function save() {
        if ($this->photo_id) {
            $this->update();
        }
        else {
            if (!empty($this->errors)) {
                return false;
            }

            if (empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "The file was not available.";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

            if (file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already existed.";
                return false;
            }

            if (move_uploaded_file($this->tmp_path,$target_path)) {
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            }
            else {
                $this->errors[] = "The file directory probably does not have permission";
                return false;
            }
        }
    }

}

?>