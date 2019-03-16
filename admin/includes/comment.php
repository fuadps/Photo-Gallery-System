<?php

class Comment extends Db_object {
    protected static $db_table = "comments";
    protected static $db_table_fields = array('comment_id','photo_id','author','body');
    protected static $id_field = "comment_id";

    public $comment_id;
    public $photo_id;
    public $author;
    public $body;

    public static function create_comment ($photo_id,$author = "Anonymous",$body = "") {
        if (!empty($photo_id) && !empty($author) && !empty($body)) {
            $comment = new Comment();

            $comment->photo_id = $photo_id;
            $comment->author = $author;
            $comment->body = $body;

            return $comment;
        }
        else {
            return false;
        }
    }

    public static function find_the_comments($photo_id = 0) {
        global $database;

        $sql = "SELECT * FROM ". self::$db_table ." 
                WHERE photo_id = ".$database->escape_string($photo_id)."
                ORDER BY ". self::$id_field ." ASC" ;
        
        return self::find_by_query($sql);
    }
}

?>