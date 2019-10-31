<?php
namespace Alexandr\Animator\Base;

class Session
{
    private $session;

    public function __construct()
    {
        $this->session = $_SESSION;
    }

    public function start(){
        session_start();
    }

    public function setData($key, $value){ // null null
        if (!$key or !$value) {
            // выбросить исключение
            var_dump('передайте корректные $key и $value');
            return false;
        }
        $this->session[$key] = $value;
//        return true;
    }

    public function getData($key){
        if(!isset($this->session[$key])) {
            // выбросить исключение
            var_dump('$key не найден');
            return false;
        }
        return $this->session[$key];
    }

    public function close(){
        session_destroy();
        unset($this->session);
    }
}