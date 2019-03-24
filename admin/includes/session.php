<?php

class Session {
    private $signed_in = false;
    public $user_id;
    public $username;
    public $message;
    public $count;

    function __construct()
    {
        session_start();
        $this->check_the_login();
        $this->check_message();
    }

    public function visitor_count() {
        return isset($_SESSION['count']) ? $this->count = $_SESSION['count']++ : $_SESSION['count'] = 1;
    }

    public function is_signed_in() {
        return $this->signed_in;
    }

    public function login($user) {
        if($user) {
            print_r($user);
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->username = $_SESSION['username'] = $user->username;
            $this->signed_in = true;
        }
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($this->user_id);
        unset($this->username);
        $this->signed_in = false;
    }

    function check_the_login () {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->username = $_SESSION['username'];
            $this->signed_in = true;
        }
        else {
            unset($this->user_id);
            unset($this->username);
            $this->signed_in = false;
        }
    }

    public function message($msg = "") {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        }
        else {
            $this->message;
        }
    }

    private function check_message() {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        else {
            $this->message = "";
        }
    }
}

$session = new Session();

?>