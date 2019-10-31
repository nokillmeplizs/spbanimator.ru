<?php
namespace Alexandr\Animator\Base;

class Cookies
{
    public function setCookie($name, $value, $time){
        // добавить возможность установки значений по умолчанию
        setcookie($name, $value, $time);
    }

    public function delCookie(){
        // реализовать удаление Cookie
    }

    public function setField($f){
        $this->field = $f;
    }
    // реализовать методы получения данных
}




